<?php

namespace App\Repository;

use App\Entity\Bilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bilder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bilder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bilder[]    findAll()
 * @method Bilder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BilderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bilder::class);
    }

    // /**
    //  * @return Bilder[] Returns an array of Bilder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bilder
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
