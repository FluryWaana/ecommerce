<?php

namespace App\Controller;

use App\Entity\ArticleCategorie;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends Controller
{
    /**
     * @Route("/categorie/{id}", name="categorie")
     */
    public function index( $id )
    {
        $repository = $this->getDoctrine()->getRepository(ArticleCategorie::class );
        $categorie = $repository->find( $id );

        return $this->render('categorie/index.html.twig', [
            'categorie'  => $categorie,
            'categories' => $this->getCategories()
        ]);
    }
}
