<?php

namespace App\Repository;

use App\Entity\Compos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Compos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compos[]    findAll()
 * @method Compos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComposRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Compos::class);
    }

    // /**
    //  * @return Compos[] Returns an array of Compos objects
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
    public function findOneBySomeField($value): ?Compos
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
