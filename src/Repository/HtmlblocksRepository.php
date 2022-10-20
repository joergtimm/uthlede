<?php

namespace App\Repository;

use App\Entity\Htmlblocks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Htmlblocks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Htmlblocks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Htmlblocks[]    findAll()
 * @method Htmlblocks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HtmlblocksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Htmlblocks::class);
    }

    // /**
    //  * @return Htmlblocks[] Returns an array of Htmlblocks objects
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
    public function findOneBySomeField($value): ?Htmlblocks
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
