<?php

namespace App\Controller;

use App\Form\UpdatePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{   
    public function __construct(public EntityManagerInterface $em){


    }

    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
           
        ]);
    }

    #[Route('/account/update_password', name: 'app_account_update_password')]
    public function updatePassword(Request $request, UserPasswordHasherInterface $userHasher): Response
    {   
        $user = $this->getUser();
        $form = $this ->createForm(UpdatePasswordType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $old_password = $form->get('oldPassword')->getData();
            
            if($userHasher->isPasswordValid($user, $old_password)){
                $new_password = $form->get('newPassword')->getData();
                $password = $userHasher ->hashPassword(
                    $user,
                    $new_password
                );
                $user->setPassword($password);
                $this->em->persist($user);
                $this->em->flush();
                $this->addFlash('success', 'Votre mot de passe est bien mis à jour');
            }
            
        
        }


        return $this->render('account/updatePassword.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
