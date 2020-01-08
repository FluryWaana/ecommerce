<?php

namespace App\Repository;

use App\Entity\ArticleCategorieCaracteristique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArticleCategorieCaracteristique|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleCategorieCaracteristique|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleCategorieCaracteristique[]    findAll()
 * @method ArticleCategorieCaracteristique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleCategorieCaracteristiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleCategorieCaracteristique::class);
    }

    // /**
    //  * @return ArticleCategorieCaracteristique[] Returns an array of ArticleCategorieCaracteristique objects
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
    public function findOneBySomeField($value): ?ArticleCategorieCaracteristique
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
