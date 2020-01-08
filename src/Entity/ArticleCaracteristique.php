<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleCaracteristiqueRepository")
 */
class ArticleCaracteristique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $article_caracteristique_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $article_caracteristique_valeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="caracteristiques")
     * @ORM\JoinColumn(name="article_reference", referencedColumnName="article_reference", nullable=false)
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleCategorieCaracteristique", inversedBy="articleCaracteristiques")
     * @ORM\JoinColumn(name="article_categorie_caracteristique_id", referencedColumnName="article_categorie_caracteristique_id", nullable=false)
     */
    private $article_categorie_caracteristique;

    public function getId(): ?int
    {
        return $this->article_caracteristique_id;
    }

    public function getArticleCaracteristiqueValeur(): ?string
    {
        return $this->article_caracteristique_valeur;
    }

    public function setArticleCaracteristiqueValeur(string $article_caracteristique_valeur): self
    {
        $this->article_caracteristique_valeur = $article_caracteristique_valeur;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getArticleCategorieCaracteristique(): ?ArticleCategorieCaracteristique
    {
        return $this->article_categorie_caracteristique;
    }

    public function setArticleCategorieCaracteristique(?ArticleCategorieCaracteristique $article_categorie_caracteristique): self
    {
        $this->article_categorie_caracteristique = $article_categorie_caracteristique;

        return $this;
    }
}
