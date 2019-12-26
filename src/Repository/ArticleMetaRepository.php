<?php

namespace App\Repository;

use App\Entity\ArticleMeta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArticleMeta|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleMeta|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleMeta[]    findAll()
 * @method ArticleMeta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleMetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleMeta::class);
    }

    // /**
    //  * @return ArticleMeta[] Returns an array of ArticleMeta objects
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
    public function findOneBySomeField($value): ?ArticleMeta
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
