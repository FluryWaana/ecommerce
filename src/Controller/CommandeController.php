<?php

namespace App\Controller;

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
}
