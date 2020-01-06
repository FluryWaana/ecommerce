<?php

namespace App\Controller\admin;

use App\Entity\ArticleCategorie;
use App\Entity\Image;
use App\Form\ArticleCategorieType;
use App\Repository\ArticleCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

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

        $entityManager = $this->getDoctrine()->getManager();

        if ( $form->isSubmitted() && $form->isValid() )
        {
            try
            {
                // Récupération de l'image
                $image = $form['image_uri']->getData();

                // Vérifie si l'image est présent dans la requête
                if( is_null( $image ) )
                {
                    throw new Exception('Une image est obligatoire pour créer une catégorie.');
                }

                // Attribut un nom unique a l'image
                $newName = uniqid() . '.' . $image->guessExtension();

                // Déplace l'image dans le répertoire public/images
                $image->move(
                    $this->getParameter('images_directory'),
                    $newName
                );

                // Création de l'image
                $imageCategorie = new Image();
                $imageCategorie->setImageUri('images/' . $newName);
                $entityManager->persist( $imageCategorie );

                // Mise à jour de la catégorie
                $articleCategorie->setImageUri( $imageCategorie );

                $entityManager->persist($articleCategorie);
                $entityManager->flush();

                return $this->redirectToRoute('categorie_index');
            }
            catch ( FileException $e )
            {
                $this->addFlash('errors', 'Une erreur est survenue lors de l\'upload de l\'image');
            }
            catch ( Exception $e )
            {
                $this->addFlash('errors', $e->getMessage());
            }
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
        $entityManager = $this->getDoctrine()->getManager();

        try
        {
            // Récupération de l'image
            $image = $form['image_uri']->getData();

            // Vérifie si l'image est présent dans la requête
            if( ! is_null( $image ) )
            {
                // Instanciation du FileSystem
                $filesystem = new Filesystem();

                // Si le fichier existe alors on le supprime
                if( $filesystem->exists( $articleCategorie->getImageUri()->getImageUri() ) )
                {
                    $filesystem->remove( $articleCategorie->getImageUri()->getImageUri() );
                }

                // Attribut un nom unique a l'image
                $newName = uniqid() . '.' . $image->guessExtension();

                // Déplace l'image dans le répertoire public/images
                $image->move(
                    $this->getParameter('images_directory'),
                    $newName
                );

                // Création de l'image
                $imageCategorie = new Image();
                $imageCategorie->setImageUri('images/' . $newName);
                $entityManager->persist( $imageCategorie );

                $articleCategorie->setImageUri( $imageCategorie );
            }

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager->flush();

                return $this->redirectToRoute('categorie_index');
            }
        }
        catch ( FileException $e )
        {
            $this->addFlash('errors', 'Une erreur est survenue lors de la mise à jour de l\'image');
        }
        catch ( Exception $e )
        {
            $this->addFlash('errors', $e->getMessage());
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
