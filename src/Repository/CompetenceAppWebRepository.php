<?php

namespace App\Repository;

use App\Entity\CompetenceAppWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompetenceAppWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetenceAppWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetenceAppWeb[]    findAll()
 * @method CompetenceAppWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetenceAppWebRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompetenceAppWeb::class);
    }

    // /**
    //  * @return CompetenceAppWeb[] Returns an array of CompetenceAppWeb objects
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
    public function findOneBySomeField($value): ?CompetenceAppWeb
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
