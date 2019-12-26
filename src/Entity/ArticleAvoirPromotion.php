<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleAvoirPromotionRepository")
 */
class ArticleAvoirPromotion
{
    /**
     * @ORM\Column(type="date")
     */
    private $avoir_promotion_debut;

    /**
     * @ORM\Column(type="date")
     */
    private $avoir_promotion_fin;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="hasPromotions")
     * @ORM\JoinColumn(name="article_reference", referencedColumnName="article_reference", nullable=false)
     */
    private $article;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticlePromotion", inversedBy="hasArticle")
     * @ORM\JoinColumn(name="article_promotion_id", referencedColumnName="article_promotion_id", nullable=false)
     */
    private $articlePromotion;

    public function getAvoirPromotionDebut(): ?\DateTimeInterface
    {
        return $this->avoir_promotion_debut;
    }

    public function setAvoirPromotionDebut(\DateTimeInterface $avoir_promotion_debut): self
    {
        $this->avoir_promotion_debut = $avoir_promotion_debut;

        return $this;
    }

    public function getAvoirPromotionFin(): ?\DateTimeInterface
    {
        return $this->avoir_promotion_fin;
    }

    public function setAvoirPromotionFin(\DateTimeInterface $avoir_promotion_fin): self
    {
        $this->avoir_promotion_fin = $avoir_promotion_fin;

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

    public function getArticlePromotion(): ?ArticlePromotion
    {
        return $this->articlePromotion;
    }

    public function setArticlePromotion(?ArticlePromotion $articlePromotion): self
    {
        $this->articlePromotion = $articlePromotion;

        return $this;
    }
}
