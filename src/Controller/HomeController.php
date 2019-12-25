<?php

namespace App\Controller;

use App\Entity\ProduitCategorie;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categories'      => $this->getCategories()
        ]);
    }
}
