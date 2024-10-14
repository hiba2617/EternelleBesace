<?php

namespace App\Controller;

use App\Provider\CartProvider;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{   
    public function __construct(private CartProvider $cartProvider, private ProductRepository $productRepository)
    {

    }

    #[Route('/mon-panier', name: 'app_cart')]
    public function index(): Response
    {
        $cartProducts = [];
        $cart = $this->cartProvider->getCart();
        if (is_array($cart)){
            foreach ($cart as $id => $quantity){
            $cartProducts [] = [
                'product'=> $this->productRepository->findOneById($id),
                'quantity' => $quantity
            ];
        }
    } else {
        $cart = [];
    }
        return $this->render('cart/index.html.twig', [
            'cartProducts' => $cartProducts
        ]);
    }
    
    #[Route('/cart/add/{id}', name: 'app_add_cart', options:["expose"=> true])]
    public function add($id): Response
    {
        $this->cartProvider->addCart($id);
        return $this->redirectToRoute('app_cart');
   
    }

    #[Route('/cart/remove', name: 'app_remove_cart')]
    public function removeCart(): Response
    {
        $this->cartProvider->removeCart();
        return $this->redirectToRoute('app_cart');
    }

        
    #[Route('/cart/delete/product/{id}', name: 'app_delete_product_cart')]
    public function deleteProduct($id): Response
    {
        $this->cartProvider->deleteProductFromCart($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/decrease/product/{id}', name: 'app_decrease_product_cart')]
    public function decreaseProduct($id): Response
    {
        $this->cartProvider->decreaseNbProductFromCart($id);
        return $this->redirectToRoute('app_cart');

    }

}
