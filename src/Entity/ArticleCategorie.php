<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="categorie")
     */
    private $articles;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", inversedBy="articleCategorie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image_uri", referencedColumnName="image_uri", nullable=false)
     */
    private $image_uri;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

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
            $article->setCategorie($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getCategorie() === $this) {
                $article->setCategorie(null);
            }
        }

        return $this;
    }

    public function getImageUri(): ?Image
    {
        return $this->image_uri;
    }

    public function setImageUri(Image $image_uri): self
    {
        $this->image_uri = $image_uri;

        return $this;
    }
}
