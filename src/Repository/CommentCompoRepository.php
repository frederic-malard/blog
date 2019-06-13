<?php

namespace App\Repository;

use App\Entity\CommentCompo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentCompo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentCompo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentCompo[]    findAll()
 * @method CommentCompo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentCompoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentCompo::class);
    }

    // /**
    //  * @return CommentCompo[] Returns an array of CommentCompo objects
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
    public function findOneBySomeField($value): ?CommentCompo
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
