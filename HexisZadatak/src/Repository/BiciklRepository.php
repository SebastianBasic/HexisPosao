<?php

namespace App\Repository;

use App\Entity\Bicikl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bicikl|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bicikl|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bicikl[]    findAll()
 * @method Bicikl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiciklRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bicikl::class);
    }

    // /**
    //  * @return Bicikl[] Returns an array of Bicikl objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bicikl
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
