<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeAvoirArticleRepository")
 */
class CommandeAvoirArticle
{
    /**
     * @ORM\Column(type="integer")
     */
    private $commande_avoir_article_quantite;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="commandeAvoirArticles")
     * @ORM\JoinColumn(name="commande_reference", referencedColumnName="commande_reference", nullable=false)
     */
    private $commande;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="commandeAvoirArticles")
     * @ORM\JoinColumn(name="article_reference", referencedColumnName="article_reference", nullable=false)
     */
    private $article;

    public function getId()
    {
        return [ $this->commande, $this->article ];
    }

    public function getCommandeAvoirArticleQuantite(): ?int
    {
        return $this->commande_avoir_article_quantite;
    }

    public function setCommandeAvoirArticleQuantite(int $commande_avoir_article_quantite): self
    {
        $this->commande_avoir_article_quantite = $commande_avoir_article_quantite;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

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
}
