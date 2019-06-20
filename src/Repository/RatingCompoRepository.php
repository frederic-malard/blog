<?php

namespace App\Repository;

use App\Entity\RatingCompo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RatingCompo|null find($id, $lockMode = null, $lockVersion = null)
 * @method RatingCompo|null findOneBy(array $criteria, array $orderBy = null)
 * @method RatingCompo[]    findAll()
 * @method RatingCompo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatingCompoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RatingCompo::class);
    }

    // /**
    //  * @return RatingCompo[] Returns an array of RatingCompo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RatingCompo
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
