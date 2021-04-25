<?php

namespace App\Repository;

use App\Entity\Themen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Themen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Themen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Themen[]    findAll()
 * @method Themen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Themen::class);
    }



    // /**
    //  * @return Themen[] Returns an array of Themen objects
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
    public function findOneBySomeField($value): ?Themen
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
