<?php

namespace App\Repository;

use App\Entity\Texte;
use App\Repository\ArtworkRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Texte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Texte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Texte[]    findAll()
 * @method Texte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TexteRepository extends ArtworkRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Texte::class);
    }

    // /**
    //  * @return Texte[] Returns an array of Texte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Texte
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
