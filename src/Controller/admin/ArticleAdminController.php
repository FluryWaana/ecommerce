<?php

namespace App\Controller\admin;

use App\Entity\Article;
use App\Entity\Image;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/article")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('admin/article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {

            try
            {
                // Récupération de l'image
                $image = $form['image_uri']->getData();

                // Vérifie si l'image est présent dans la requête
                if( is_null( $image ) )
                {
                    throw new Exception('Une image est obligatoire pour créer un article.');
                }

                // Attribut un nom unique a l'image
                $newName = uniqid() . '.' . $image->guessExtension();

                // Déplace l'image dans le répertoire public/images
                $image->move(
                    $this->getParameter('images_directory'),
                    $newName
                );

                $entityManager->persist($article);

                // Création de l'image
                $imageArticle = new Image();
                $imageArticle->setImageUri('images/' . $newName);
                $imageArticle->setArticle($article);
                $entityManager->persist( $imageArticle );

                // Mise à jour de l'article
                $article->addImageUri( $imageArticle );

                $entityManager->flush();

                return $this->redirectToRoute('article_index');
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

        return $this->render('admin/article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{article_reference}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('admin/article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{article_reference}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
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

                // Attribut un nom unique a l'image
                $newName = uniqid() . '.' . $image->guessExtension();

                // Déplace l'image dans le répertoire public/images
                $image->move(
                    $this->getParameter('images_directory'),
                    $newName
                );

                // Création de l'image
                $imageArticle = new Image();
                $imageArticle->setImageUri('images/' . $newName);
                $entityManager->persist( $imageArticle );

                $article->addImageUri( $imageArticle );
            }

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager->flush();

                return $this->redirectToRoute('article_index');
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

        return $this->render('admin/article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{article_reference}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getArticle_reference(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $filesystem = new Filesystem();
            $imageUris = $article->getImageUri();
            $repoImage = $entityManager->getRepository(Image::class);

            foreach($imageUris as $value) {

                if ($filesystem->exists($value->getImageUri())) {
                    $filesystem->remove($value->getImageUri());
                }
                $img = $repoImage->find($value->getImageUri());
                $entityManager->remove($img);
            }
            $entityManager->flush();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }
}
