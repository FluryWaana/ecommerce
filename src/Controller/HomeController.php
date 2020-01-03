<?php

namespace App\Controller;

use App\Repository\ArticleCategorieRepository;
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

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        $repo = $this->getDoctrine()->getRepository( ArticleCategorieRepository::class );
    }
}
