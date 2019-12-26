<?php

namespace App\Repository;

use App\Entity\ArticlePromotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArticlePromotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlePromotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlePromotion[]    findAll()
 * @method ArticlePromotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlePromotionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlePromotion::class);
    }

    // /**
    //  * @return ArticlePromotion[] Returns an array of ArticlePromotion objects
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
    public function findOneBySomeField($value): ?ArticlePromotion
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
