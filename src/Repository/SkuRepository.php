<?php

namespace App\Repository;

use App\Entity\Sku;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Sku|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sku|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sku[]    findAll()
 * @method Sku[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sku::class);
    }

    // /**
    //  * @return Sku[] Returns an array of Sku objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sku
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
