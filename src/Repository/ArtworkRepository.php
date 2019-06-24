<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ?|null find($id, $lockMode = null, $lockVersion = null)
 * @method ?|null findOneBy(array $criteria, array $orderBy = null)
 * @method ?[]    findAll()
 * @method ?[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
abstract class ArtworkRepository extends ServiceEntityRepository
{
    public function findToDisplay($offset, $limit)
    {
        $result = $this->createQueryBuilder('a')
            ->andWhere('a.display = :val OR a.display IS null')
            ->setParameter('val', true)
            ->orderBy('a.id', 'ASC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;

        return $result;
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
