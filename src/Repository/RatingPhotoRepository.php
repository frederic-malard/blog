<?php

namespace App\Repository;

use App\Entity\RatingPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RatingPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method RatingPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method RatingPhoto[]    findAll()
 * @method RatingPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatingPhotoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RatingPhoto::class);
    }

    // /**
    //  * @return RatingPhoto[] Returns an array of RatingPhoto objects
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
    public function findOneBySomeField($value): ?RatingPhoto
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
