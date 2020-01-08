<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     */
    public function index( $id )
    {
        $repo = $this->getDoctrine()->getRepository( Article::class );

        // Récupération de l'article
        $article = $repo->find( $id );

        if( is_null( $article ) )
        {
            throw new NotFoundHttpException('Cette article n\'existe pas');
        }

        return $this->render('article/index.html.twig', [
            'article'         => $article
        ]);
    }
}
