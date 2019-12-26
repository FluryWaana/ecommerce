<?php

namespace App\Repository;

use App\Entity\CommandeAvoirArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CommandeAvoirArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeAvoirArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeAvoirArticle[]    findAll()
 * @method CommandeAvoirArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeAvoirArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeAvoirArticle::class);
    }

    // /**
    //  * @return CommandeAvoirArticle[] Returns an array of CommandeAvoirArticle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommandeAvoirArticle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
