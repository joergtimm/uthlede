<?php

namespace App\Repository;

use App\Entity\ArtikelMitwirkungen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArtikelMitwirkungen|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtikelMitwirkungen|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtikelMitwirkungen[]    findAll()
 * @method ArtikelMitwirkungen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtikelMitwirkungenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtikelMitwirkungen::class);
    }

    // /**
    //  * @return ArtikelMitwirkungen[] Returns an array of ArtikelMitwirkungen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArtikelMitwirkungen
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
