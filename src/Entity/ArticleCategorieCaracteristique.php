<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleCategorieCaracteristiqueRepository")
 */
class ArticleCategorieCaracteristique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $article_categorie_caracteristique_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $article_categorie_caracteristique_nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ArticleCategorie", inversedBy="caracteristiques")
     * @JoinTable(name="categorie_avoir_nom_caracteristique",
     *      joinColumns={@ORM\JoinColumn(name="article_categorie_caracteristique_id", referencedColumnName="article_categorie_caracteristique_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="article_categorie_id", referencedColumnName="article_categorie_id")}
     * )
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleCaracteristique", mappedBy="article_categorie_caracteristique")
     */
    private $articleCaracteristiques;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->articleCaracteristiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->article_categorie_caracteristique_id;
    }

    public function getArticleCategorieCaracteristiqueNom(): ?string
    {
        return $this->article_categorie_caracteristique_nom;
    }

    public function setArticleCategorieCaracteristiqueNom(string $article_categorie_caracteristique_nom): self
    {
        $this->article_categorie_caracteristique_nom = $article_categorie_caracteristique_nom;

        return $this;
    }

    /**
     * @return Collection|ArticleCategorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(ArticleCategorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(ArticleCategorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|ArticleCaracteristique[]
     */
    public function getArticleCaracteristiques(): Collection
    {
        return $this->articleCaracteristiques;
    }

    public function addArticleCaracteristique(ArticleCaracteristique $articleCaracteristique): self
    {
        if (!$this->articleCaracteristiques->contains($articleCaracteristique)) {
            $this->articleCaracteristiques[] = $articleCaracteristique;
            $articleCaracteristique->setArticleCategorieCaracteristique($this);
        }

        return $this;
    }

    public function removeArticleCaracteristique(ArticleCaracteristique $articleCaracteristique): self
    {
        if ($this->articleCaracteristiques->contains($articleCaracteristique)) {
            $this->articleCaracteristiques->removeElement($articleCaracteristique);
            // set the owning side to null (unless already changed)
            if ($articleCaracteristique->getArticleCategorieCaracteristique() === $this) {
                $articleCaracteristique->setArticleCategorieCaracteristique(null);
            }
        }

        return $this;
    }
}
