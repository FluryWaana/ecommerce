<?php

namespace App\Controller;

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
