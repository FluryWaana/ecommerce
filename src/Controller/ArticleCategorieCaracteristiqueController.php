<?php

namespace App\Controller;

use App\Entity\ArticleCategorieCaracteristique;
use App\Form\ArticleCategorieCaracteristiqueType;
use App\Repository\ArticleCategorieCaracteristiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/caracteristique")
 */
class ArticleCategorieCaracteristiqueController extends AbstractController
{
    /**
     * @Route("/", name="caracteristique_index", methods={"GET"})
     */
    public function index(ArticleCategorieCaracteristiqueRepository $articleCategorieCaracteristiqueRepository): Response
    {
        return $this->render('admin/caracteristique/index.html.twig', [
            'article_categorie_caracteristiques' => $articleCategorieCaracteristiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="caracteristique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $articleCategorieCaracteristique = new ArticleCategorieCaracteristique();
        $form = $this->createForm(ArticleCategorieCaracteristiqueType::class, $articleCategorieCaracteristique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleCategorieCaracteristique);
            $entityManager->flush();

            return $this->redirectToRoute('caracteristique_index');
        }

        return $this->render('admin/caracteristique/new.html.twig', [
            'caracteristique' => $articleCategorieCaracteristique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caracteristique_show", methods={"GET"})
     */
    public function show(ArticleCategorieCaracteristique $articleCategorieCaracteristique): Response
    {
        return $this->render('admin/caracteristique/show.html.twig', [
            'article_categorie_caracteristique' => $articleCategorieCaracteristique,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="caracteristique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArticleCategorieCaracteristique $articleCategorieCaracteristique): Response
    {
        $form = $this->createForm(ArticleCategorieCaracteristiqueType::class, $articleCategorieCaracteristique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caracteristique_index');
        }

        return $this->render('admin/caracteristique/edit.html.twig', [
            'article_categorie_caracteristique' => $articleCategorieCaracteristique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caracteristique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ArticleCategorieCaracteristique $articleCategorieCaracteristique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleCategorieCaracteristique->getArticleCategorieCaracteristiqueId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleCategorieCaracteristique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caracteristique_index');
    }
}
