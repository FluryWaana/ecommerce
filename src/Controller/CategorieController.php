<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleCategorie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends Controller
{
    /**
     * @Route("/categorie", name="categorie_index")
     * @return Response
     */
    public function index() {
        $repo = $this->getDoctrine()->getRepository(ArticleCategorie::class);

        return $this->render('categorie/index.html.twig', [
            'categories' => $repo->findAll()
        ]);
    }

    //------------------------------------------------------------------------

    /**
     * @Route("/categorie/{id}", name="categorie")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function show(Request $request, int $id )
    {
        // Nombre limite d'article par page
        $nb_article_max = 5;

        // Page par défaut
        $num_page = 1;

        // Récupération des repositories
        $repo_cat = $this->getDoctrine()->getRepository( ArticleCategorie::class);
        $repo_art = $this->getDoctrine()->getRepository( Article::class);

        // Récupération de la catégorie passer en paramètre
        $categorie = $repo_cat->find( $id );

        // Vérifie si la catégorie existe
        if( is_null( $categorie ) )
        {
            return $this->redirectToRoute('home');
        }

        if( is_integer( intval( $request->get('page') ) ) && $request->get('page') > 0)
        {
            $num_page = $request->get('page');
        }

        // Récupération des articles de la catégorie (Paginate)
        $articles = $repo_art->getArticlesPaginate( $categorie, $num_page, $nb_article_max );

        /**
         * Si la page demandé contient 0 article l'utilisateur
         * est redirigé à la page 1 par défaut
         */
        if( $articles->getIterator()->count() === 0 )
        {
            return $this->redirectToRoute('categorie', ['id' => $categorie->getId()]);
        }

        /**
         * Variable utile pour la pagination sur TWIG.
         * Calcul le nombre de page total en fonction du nombre d'article à afficher
         * Ceil permet d'arrondir au nombre au dessus
         */
        $nb_page_max = ceil( $articles->count() / $nb_article_max);

        return $this->render('categorie/show.html.twig', [
            'categorie'  => $categorie,
            'categories' => $this->getCategories(),
            'articles'   => $articles,
            'page_max'   => $nb_page_max,
            'num_page'   => $num_page
        ]);
    }
}
