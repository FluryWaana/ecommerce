<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="string", length=255)
     */
    private $image_uri;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ArticleCategorie", mappedBy="image_uri", cascade={"persist", "remove"})
     */
    private $articleCategorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="image_uri")
     * @ORM\JoinColumn(name="article_reference", referencedColumnName="article_reference", nullable=true)
     */
    private $article;

    public function getImageUri(): ?int
    {
        return $this->image_uri;
    }

    public function setImageUri( string $image_uri ): self
    {
        $this->image_uri = $image_uri;

        return $this;
    }

    public function getArticleCategorie(): ?ArticleCategorie
    {
        return $this->articleCategorie;
    }

    public function setArticleCategorie(ArticleCategorie $articleCategorie): self
    {
        $this->articleCategorie = $articleCategorie;

        // set the owning side of the relation if necessary
        if ($articleCategorie->getImageUri() !== $this) {
            $articleCategorie->setImageUri($this);
        }

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
