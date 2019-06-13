<?php

namespace App\Repository;

use App\Entity\CommentTexte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentTexte|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentTexte|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentTexte[]    findAll()
 * @method CommentTexte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentTexteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentTexte::class);
    }

    // /**
    //  * @return CommentTexte[] Returns an array of CommentTexte objects
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
    public function findOneBySomeField($value): ?CommentTexte
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
