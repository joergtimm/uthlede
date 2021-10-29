<?php

namespace App\Repository;

use App\Entity\Articel;
use App\Entity\Themen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articel[]    findAll()
 * @method Articel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articel::class);
    }

    /**
     * //
     * @param string|null $value
     * @return QueryBuilder
     */

    public function findByQueryBuilder(?string $value): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.haupttext LIKE :val OR a.titel LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('a.createAt', 'DESC')
            ;
    }

    /**
     * @param $value
     * @param int|null $thema
     * @return QueryBuilder
     */
    public function listQueryBuilder($value, int $thema = null): QueryBuilder
    {
        $qb =  $this->createQueryBuilder('a')
            ->andWhere('a.titel LIKE :val OR a.haupttext LIKE :val')
            ->setParameter('val', '%'.$value.'%');

        if ($thema) { $qb
            ->andWhere('a.thema.id = :tma')
            ->setParameter('tma', $thema);
        }

            $qb->orderBy('a.datum', 'DESC');

        return $qb;
    }

    // /**
    //  * @return Articel[] Returns an array of Articel objects
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
    public function findOneBySomeField($value): ?Articel
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
