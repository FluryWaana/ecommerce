<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleMetaRepository")
 */
class ArticleMeta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $article_meta_id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $article_meta_nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="meta")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->article_meta_id;
    }

    public function getArticleMetaNom(): ?string
    {
        return $this->article_meta_nom;
    }

    public function setArticleMetaNom(string $article_meta_nom): self
    {
        $this->article_meta_nom = $article_meta_nom;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addMetum($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->removeMetum($this);
        }

        return $this;
    }
}
