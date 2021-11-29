<?php

namespace App\Repository;

use App\Entity\Tankstellen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tankstellen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tankstellen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tankstellen[]    findAll()
 * @method Tankstellen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TankstellenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tankstellen::class);
    }

    // /**
    //  * @return Tankstellen[] Returns an array of Tankstellen objects
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
    public function findOneBySomeField($value): ?Tankstellen
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
