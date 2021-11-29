<?php

namespace App\Repository;

use App\Entity\PersVer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersVer|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersVer|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersVer[]    findAll()
 * @method PersVer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersVerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersVer::class);
    }

    // /**
    //  * @return PersVer[] Returns an array of PersVer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PersVer
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
