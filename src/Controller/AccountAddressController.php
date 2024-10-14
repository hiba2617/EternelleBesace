<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccountAddressController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em){

    }

    #[Route('/compte/adresse', name: 'app_account_address')]
    public function index(): Response
    {
        return $this->render('account/address.html.twig', [
    
                ]);
    }

    #[Route('/compte/adresse/ajout', name: 'app_account_address_add')]
    public function addAddress(Request $request): Response
    {
        $address = new Address;
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if (!$user) {
                //rajout TB : Loggez ou débuggez ici pour comprendre pourquoi l'utilisateur n'est pas authentifié
                dump('L’utilisateur n’est pas authentifié.');
                return $this->redirectToRoute('app_login');
            }
            $address->setUser($this->getUser());
            $this->em->persist($address);
            $this->em->flush();
            return $this->redirectToRoute('app_account_address');
        }

        return $this->render('account/add_address.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
