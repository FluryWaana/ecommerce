<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\ProduitCategorie;

class Controller extends AbstractController
{
    /**
     * Retourne toutes les catégories d'articles
     * @return ProduitCategorie[]
     */
    protected function getCategories() : Array
    {
        return $this->getDoctrine()->getRepository( ProduitCategorie::class )->findAll();
    }
}
