<?php

namespace App\Repository;

use App\Entity\Dessin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dessin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dessin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dessin[]    findAll()
 * @method Dessin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DessinRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dessin::class);
    }

    // /**
    //  * @return Dessin[] Returns an array of Dessin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dessin
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
