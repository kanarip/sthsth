<?php

namespace App\Repository;

use App\Entity\Entitlement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Entitlement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entitlement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entitlement[]    findAll()
 * @method Entitlement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntitlementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entitlement::class);
    }

    // /**
    //  * @return Entitlement[] Returns an array of Entitlement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entitlement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
