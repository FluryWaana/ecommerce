<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\PanierAddArticleType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends Controller
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index()
    {
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'categories' => $this->getCategories()
        ]);
    }

    /**
     * @Route("/panier/article", name="panier_add_article", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addArticle(Request $request) : Response
    {
        $repo_article = $this->getDoctrine()->getRepository( Article::class );

        $data = json_decode( $request->getContent(), true );

        $form = $this->createForm(PanierAddArticleType::class );
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération de l'article
            $article = $repo_article->find($data['article_reference']);

            if( is_null( $article ) )
            {
                $form->addError( new FormError('L\'article avec la référence ' . $data['article_reference'] . ' n\'existe pas'));
            }
            else
            {
                // Récupération de la session utilisateur
                $session = $request->getSession();
                $panier  = $session->get('panier');

                // Si l'article à été ajouté au cookie
                $add = false;

                if( is_null( $panier ) )
                {
                    $session->set('panier', [
                        [
                            'article'  => $article,
                            'quantite' => $data['article_quantite']
                        ]
                    ]);
                }
                else
                {
                    foreach( $panier as $key => $value )
                    {
                        if( $value['article']->getArticleReference() === $article->getArticleReference() )
                        {
                            $panier[$key]['quantite'] += $data['article_quantite'];
                            $add = true;
                        }
                    }

                    if( ! $add )
                    {
                        $panier[] = [
                            'article'  => $article,
                            'quantite' => $data['article_quantite']
                        ];
                    }

                    $session->set('panier', $panier);
                }

                return $this->json([
                    'status'  => 'success',
                    'message' => 'L\'article a bien été ajouté au panier'
                ], 200);
            }
        }

        return $this->json([
            'status' => 'error',
            'errors' => $form->getErrors(true)
        ],400);
    }
}
