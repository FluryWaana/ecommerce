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
        // Récupère le répository d'Article
        $repo_article = $this->getDoctrine()->getRepository( Article::class );

        // Décode le JSON en entrée
        $data = json_decode( $request->getContent(), true );

        $form = $this->createForm(PanierAddArticleType::class );
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération de l'article
            $article = $repo_article->find($data['article_reference']);

            // Nombre d'article total dans le panier
            $quantie_article = 0;

            // Vérifie si l'article n'existe pas
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

                /**
                 * Si le panier est vide alors on créer une session contenant les articles
                 * sinon on vérifie si l'article ajouté existe déjà dans le panier.
                 */
                if( is_null( $panier ) )
                {
                    $session->set('panier', [
                        [
                            'article'  => $article,
                            'quantite' => $data['article_quantite']
                        ]
                    ]);

                    $quantie_article += $data['article_quantite'];
                }
                else
                {
                    // Parcours le panier
                    foreach( $panier as $key => $value )
                    {
                        // Si l'article ajouté existe déjà dans le panier
                        if( $value['article']->getArticleReference() === $article->getArticleReference() )
                        {
                            $panier[$key]['quantite'] += $data['article_quantite'];
                            $add = true;
                        }
                        $quantie_article += $panier[$key]['quantite'];
                    }

                    if( ! $add )
                    {
                        $panier[] = [
                            'article'  => $article,
                            'quantite' => $data['article_quantite']
                        ];
                        $quantie_article += $data['article_quantite'];
                    }

                    $session->set('panier', $panier);
                }

                $session->set('panier_count',  $quantie_article);

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

    /**
     * @Route("/panier/article/{id}", name="panier_del_article", methods={"DELETE"})
     * @param Request $request
     * @return Response
     */
    public function removeArticle( Request $request, $id ) : Response
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $article = $repo->find( $id );

        if( is_null( $article ) )
        {
            return $this->json([
                'status'  => 'Not Found',
                'message' => 'L\'article ' . $id . ' n\'existe pas'
            ],404);
        }

        // Récupération de la session utilisateur
        $session      = $request->getSession();
        $panier       = $session->get('panier');
        $panier_count = $session->get('panier_count');

        foreach( $panier as $key => $value )
        {
            // Si l'article ajouté existe déjà dans le panier
            if( $value['article']->getArticleReference() === $article->getArticleReference() )
            {
                $panier_count -= $panier[$key]['quantite'];
                unset($panier[$key]);

            }
        }

        if( count( $panier ) == 0 )
        {
            $session->remove('panier');
        }
        else
        {
            $session->set('panier', $panier);
        }

        $session->set('panier_count',  $panier_count);

        return $this->json([
            'status'  => 'success',
            'message' => 'L\'article a bien été supprimé du panier'
        ], 200);
    }


    /**
     * @Route("/panier/article/reset", name="panier_reset", methods={"get"})
     * @param Request $request
     * @return Response
     */
    public function resetPanier(Request $request)
    {
        $session = $request->getSession();
        $session->remove('panier');
        $session->remove('panier_count');
        return $this->redirectToRoute('panier');
    }
}
