<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\ArticleCategorie;

class Controller extends AbstractController
{
    /**
     * Retourne toutes les catégories d'articles
     * @return ArticleCategorie[]
     */
    protected function getCategories() : Array
    {
        return $this->getDoctrine()->getRepository( ArticleCategorie::class )->findBy(['articleCategorie' => null]);
    }
}
