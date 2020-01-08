<?php

namespace App\Controller;

use App\Entity\ArticleCategorie;
use App\Entity\ArticleCategorieCaracteristique;
use App\Entity\Image;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/compte", name="user_account")
     */
    public function index()
    {


        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'categories'      => $this->getCategories()
        ]);


    }


}
