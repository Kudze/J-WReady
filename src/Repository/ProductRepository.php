<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param $tags - Array of tag IDs.
     * @return mixed - Array of product entities.
     *
     * Fetches product enteties that contain the tags described in $tags.
     */
    public function findByTags($tags)
    {
        $qb = $this->createQueryBuilder('p');
        return $qb->andWhere($qb->expr()->in('p.tag', $tags))
            ->getQuery()
            ->getResult();

    }

    /**
     * @param $query - search text
     * @return mixed - Array of product entites or null.
     *
     * Searches the database for specific product.
     */
    public function search($query)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.tag', 't')
            ->orWhere('t.title LIKE :query')
            ->orWhere('p.title LIKE :query')
            ->orWhere('p.description LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult();

    }

    public function getFirstX($x) {
        return $this->createQueryBuilder('p')
            ->setMaxResults($x)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
