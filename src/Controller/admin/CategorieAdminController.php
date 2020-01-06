<?php

namespace App\Controller\admin;

use App\Entity\ArticleCategorie;
use App\Form\ArticleCategorieType;
use App\Repository\ArticleCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categorie")
 */
class CategorieAdminController extends AbstractController
{
    /**
     * @Route("/", name="categorie_index", methods={"GET"})
     */
    public function index(ArticleCategorieRepository $articleCategorieRepository): Response
    {
        return $this->render('admin/categorie/index.html.twig', [
            'article_categories' => $articleCategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $articleCategorie = new ArticleCategorie();
        $form = $this->createForm(ArticleCategorieType::class, $articleCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération de l'image
            $brochureFile = $form['image_uri']->getData();


            dd( $brochureFile );
            /*if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $product->setBrochureFilename($newFilename);*/







            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('article_categorie_index');
        }

        return $this->render('admin/categorie/new.html.twig', [
            'categorie' => $articleCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{article_categorie_id}", name="categorie_show", methods={"GET"})
     */
    public function show(ArticleCategorie $articleCategorie): Response
    {
        return $this->render('admin/categorie/show.html.twig', [
            'categorie' => $articleCategorie,
        ]);
    }

    /**
     * @Route("/{article_categorie_id}/edit", name="categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArticleCategorie $articleCategorie): Response
    {
        $form = $this->createForm(ArticleCategorieType::class, $articleCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('admin/categorie/edit.html.twig', [
            'categorie' => $articleCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{article_categorie_id}", name="categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ArticleCategorie $articleCategorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleCategorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }
}
