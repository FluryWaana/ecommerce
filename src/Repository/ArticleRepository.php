<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\ArticleCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param ArticleCategorie $categorie
     * @param int $num_page
     * @param int $limit_result
     * @return Paginator
     */
    public function getArticlesPaginate( ArticleCategorie $categorie, int $num_page = 1, int $limit_result = 10 )
    {
        if( $num_page < 1 )
        {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        // Création de la requête
        $query = $this->createQueryBuilder('a')
            ->where('a.categorie = :categorie_id')
            ->setParameter('categorie_id', $categorie->getId() )
            ->getQuery();

        // Offset et limit
        $query->setFirstResult( $limit_result * ( $num_page - 1))
              ->setMaxResults($limit_result);

        $paginator = new Paginator( $query );

        return $paginator;
    }

    /*
    public function findOneBySomeField($value): ?Article
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
