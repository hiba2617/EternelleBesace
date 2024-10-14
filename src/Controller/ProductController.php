<?php

namespace App\Controller;

use App\Entity\Product;
use App\Filter\Search;
use App\Form\SearchType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManagerInterface, 
        private ProductRepository $productRepository)
    {}

    #[Route('/nos-produits', name: 'app_product')]
    public function index(Request $request): Response
    {
        $Search = new Search();
        $Form = $this->createForm(SearchType::class, $Search);
        $offset = max(0, $request->query->getInt('offset', 0));
        $Form->handleRequest($request);
        $products = $this->productRepository->findBySearchFilter($Search, $offset);
            
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $Form->createView(),
            'previous' => $offset - ProductRepository::ITEMS_PER_PAGE,
            'next' => min(count($products), $offset + ProductRepository::ITEMS_PER_PAGE)
        ]);
    }

    #[Route('/nos-produits/{slug}', name: 'app_product_item')]
    public function showProduct($slug): Response
    {
        $product = $this->entityManagerInterface->getRepository(Product::class)->findOneBySlug($slug);
        return $this->render('product/showProduct.html.twig', [
            'product' => $product
        ]);
    }
}
