<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlePromotionRepository")
 */
class ArticlePromotion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $article_promotion_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $article_promotion_pourcentage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleAvoirPromotion", mappedBy="articlePromotion")
     */
    private $hasArticle;

    public function __construct()
    {
        $this->hasArticle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->article_promotion_id;
    }

    public function getArticlePromotionPourcentage(): ?int
    {
        return $this->article_promotion_pourcentage;
    }

    public function setArticlePromotionPourcentage(int $article_promotion_pourcentage): self
    {
        $this->article_promotion_pourcentage = $article_promotion_pourcentage;

        return $this;
    }

    /**
     * @return Collection|ArticleAvoirPromotion[]
     */
    public function getHasArticle(): Collection
    {
        return $this->hasArticle;
    }

    public function addHasArticle(ArticleAvoirPromotion $hasArticle): self
    {
        if (!$this->hasArticle->contains($hasArticle)) {
            $this->hasArticle[] = $hasArticle;
            $hasArticle->setArticlePromotion($this);
        }

        return $this;
    }

    public function removeHasArticle(ArticleAvoirPromotion $hasArticle): self
    {
        if ($this->hasArticle->contains($hasArticle)) {
            $this->hasArticle->removeElement($hasArticle);
            // set the owning side to null (unless already changed)
            if ($hasArticle->getArticlePromotion() === $this) {
                $hasArticle->setArticlePromotion(null);
            }
        }

        return $this;
    }
}
