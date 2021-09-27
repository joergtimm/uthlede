<?php

namespace App\Repository;

use App\Entity\Vereine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vereine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vereine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vereine[]    findAll()
 * @method Vereine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VereineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vereine::class);
    }

    // /**
    //  * @return Vereine[] Returns an array of Vereine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vereine
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
