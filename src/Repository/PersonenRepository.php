<?php

namespace App\Repository;

use App\Entity\Personen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Personen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personen[]    findAll()
 * @method Personen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personen::class);
    }

    // /**
    //  * @return Personen[] Returns an array of Personen objects
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
    public function findOneBySomeField($value): ?Personen
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
