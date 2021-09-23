<?php

namespace App\Repository;

use App\Entity\Zauzece;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Zauzece|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zauzece|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zauzece[]    findAll()
 * @method Zauzece[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZauzeceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zauzece::class);
    }

    // /**
    //  * @return Zauzece[] Returns an array of Zauzece objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zauzece
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
