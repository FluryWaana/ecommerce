<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleMeta;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $meta = $request->get('meta');
        $arrayMetaSearch = explode(' ', $meta);

        $repoMeta = $this->getDoctrine()->getRepository(ArticleMeta::class);
        $arrayMetaBdd = $repoMeta->findBy(array('article_meta_nom' => $arrayMetaSearch));

        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
        $qb->select('a')
            ->from('App\Entity\Article', 'a')
            ->innerJoin('a.meta', 'm')
            ->where('m.article_meta_id IN (:array)')
            ->setParameter('array', $arrayMetaBdd);
        $query = $qb->getQuery();
        //$listArticle = $query->getResult();

        // Nombre limite d'article par page
        $nb_article_max = 1;
        // Page par défaut
        $num_page = 1;
        if( is_integer( intval( $request->get('page') ) ) && $request->get('page') > 0)
        {
            $num_page = $request->get('page');
        }
        $query->setFirstResult( $nb_article_max * ( $num_page - 1))
            ->setMaxResults($nb_article_max);
        $listArticle = new Paginator( $query );
        $nb_page_max = ceil( $listArticle->count() / $nb_article_max);


        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'listArticles' => $listArticle,
            'page_max'   => $nb_page_max,
            'num_page'   => $num_page
        ]);
    }
}
