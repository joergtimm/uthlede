<?php

namespace App\Repository;

use App\Entity\Articel;
use App\Entity\ArtikelBilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArtikelBilder|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtikelBilder|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtikelBilder[]    findAll()
 * @method ArtikelBilder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtikelBilderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtikelBilder::class);
    }

    /**
    * @return ArtikelBilder[] Returns an array of ArtikelBilder objects
    */

    public function findByArtikel( Articel $articel): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.artikel = :art')
            ->setParameter('art', $articel)
            ->orderBy('a.position', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?ArtikelBilder
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
