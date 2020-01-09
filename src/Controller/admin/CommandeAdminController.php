<?php

namespace App\Controller\admin;

use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommandeAdminController extends AbstractController
{
    /**
     * @Route("/admin/commande", name="admin_commande")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository( Commande::class);

        return $this->render('admin/commande/index.html.twig', [
            'commandes' => $repo->findAll()
        ]);
    }
}
