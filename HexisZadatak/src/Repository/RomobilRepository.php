<?php

namespace App\Repository;

use App\Entity\Romobil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Romobil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Romobil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Romobil[]    findAll()
 * @method Romobil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RomobilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Romobil::class);
    }

    // /**
    //  * @return Romobil[] Returns an array of Romobil objects
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
    public function findOneBySomeField($value): ?Romobil
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
