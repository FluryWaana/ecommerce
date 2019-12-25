<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends Controller
{
    /**
     * @Route("/compte/mes-commandes", name="user_order")
     */
    public function index()
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'categories'      => $this->getCategories()
        ]);
    }
}
