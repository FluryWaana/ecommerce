<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 06/01/2020
 * Time: 09:18
 */

namespace App\Controller\admin;

use App\Controller\Controller;
use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index()
    {
        $repo_commande  = $this->getDoctrine()->getRepository( Commande::class );
        $commandes      = $repo_commande->findAll();
        $total          = 0;

        // Parcours les commandes
        foreach ( $commandes as $commande )
        {
            // Parcours les lignes d'une commande
            foreach( $commande->getCommandeAvoirArticles() as $ligne_commande )
            {
                $total += $ligne_commande->getArticle()->getArticlePrixHt() * $ligne_commande->getCommandeAvoirArticleQuantite();
            }
        }

        return $this->render('admin/home/index.html.twig', [
            'chiffre_affaire_annuelle' => $total
        ]);
    }
}