<?php

namespace App\Controller;

use App\Repository\ArticleCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
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
