<?php

namespace App\Repository;

use App\Entity\ArticleAvoirPromotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArticleAvoirPromotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleAvoirPromotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleAvoirPromotion[]    findAll()
 * @method ArticleAvoirPromotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleAvoirPromotionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleAvoirPromotion::class);
    }

    // /**
    //  * @return ArticleAvoirPromotion[] Returns an array of ArticleAvoirPromotion objects
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
    public function findOneBySomeField($value): ?ArticleAvoirPromotion
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
