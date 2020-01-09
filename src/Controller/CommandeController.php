<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleMeta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/compte/mes-commandes", name="user_commandes")
     */
    public function indexCommandes(Request $request) : Response
    {
        return $this->render('user/commande.html.twig', [
            'commandes' => $this->getUser()->getCommandes()
        ]);
    }

    /**
     * @Route("/commande/1", name="commande")
     */
    public function passerCommande(Request $request) : Response
    {
        // Récupération de la session cookie
        $session  = $request->getSession();
        $articles = $session->get('panier');
        dd( $articles );

        return $this->render('commande/index.html.twig', [
            'articles' => $articles
        ]);
    }

    
}
