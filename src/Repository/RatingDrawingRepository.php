<?php

namespace App\Repository;

use App\Entity\RatingDrawing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RatingDrawing|null find($id, $lockMode = null, $lockVersion = null)
 * @method RatingDrawing|null findOneBy(array $criteria, array $orderBy = null)
 * @method RatingDrawing[]    findAll()
 * @method RatingDrawing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatingDrawingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RatingDrawing::class);
    }

    // /**
    //  * @return RatingDrawing[] Returns an array of RatingDrawing objects
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
    public function findOneBySomeField($value): ?RatingDrawing
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
