<?php

namespace App\Repository;

use App\Entity\Historisch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Historisch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Historisch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Historisch[]    findAll()
 * @method Historisch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistorischRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Historisch::class);
    }

    // /**
    //  * @return Historisch[] Returns an array of Historisch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Historisch
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
