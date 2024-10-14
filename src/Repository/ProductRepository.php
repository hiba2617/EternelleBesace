<?php

namespace App\Repository;

use App\Entity\Product;
use App\Filter\Search;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    const ITEMS_PER_PAGE= 6;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    
    public function findBySearchFilter (Search $search, $offset): Paginator
    {
        $query= $this->createQueryBuilder('p')
        ->leftJoin('p.category','c');

        if(!empty ($search->SearchCategories)){
            $query = $query->andWhere('c.id IN (:categories)')
            ->setParameter('categories', $search->SearchCategories);
        }
        $name = $search->SearchName;
        if(isset($name)){
            $query = $query->andWhere('p.name LIKE :SearchName')
            ->setParameter('SearchName', "%$name%");
        }
        $query = $query->orderBy('p.name', 'ASC')

        
            ->setMaxResults(self::ITEMS_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
            // ->getResult()
        ;
        return new Paginator($query);
    }

 
}
