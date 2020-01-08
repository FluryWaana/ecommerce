<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 06/01/2020
 * Time: 09:18
 */

namespace App\Controller\admin;

use App\Controller\Controller;
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
        return $this->render('admin/home/index.html.twig', [
            'controller_name' => 'AdminController'
        ]);
    }
}