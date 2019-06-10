<?php

namespace App\Repository;

use App\Entity\CategorieDessin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategorieDessin|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieDessin|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieDessin[]    findAll()
 * @method CategorieDessin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieDessinRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategorieDessin::class);
    }

    // /**
    //  * @return CategorieDessin[] Returns an array of CategorieDessin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieDessin
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
