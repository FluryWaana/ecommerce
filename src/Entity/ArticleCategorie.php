<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleCategorieRepository")
 */
class ArticleCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $article_categorie_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $article_categorie_nom;

    public function getId(): ?int
    {
        return $this->article_categorie_id;
    }

    public function getArticleCategorieNom(): ?string
    {
        return $this->article_categorie_nom;
    }

    public function setArticleCategorieNom(string $article_categorie_nom): self
    {
        $this->article_categorie_nom = $article_categorie_nom;

        return $this;
    }
}
