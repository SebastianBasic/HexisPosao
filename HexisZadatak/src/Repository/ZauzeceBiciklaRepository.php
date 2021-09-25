<?php

namespace App\Repository;

use App\Entity\ZauzeceBicikla;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ZauzeceBicikla|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZauzeceBicikla|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZauzeceBicikla[]    findAll()
 * @method ZauzeceBicikla[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZauzeceBiciklaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZauzeceBicikla::class);
    }

    // /**
    //  * @return ZauzeceBicikla[] Returns an array of ZauzeceBicikla objects
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
    public function findOneBySomeField($value): ?ZauzeceBicikla
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
