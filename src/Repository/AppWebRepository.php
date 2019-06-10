<?php

namespace App\Repository;

use App\Entity\AppWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AppWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppWeb[]    findAll()
 * @method AppWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppWebRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppWeb::class);
    }

    // /**
    //  * @return AppWeb[] Returns an array of AppWeb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AppWeb
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
