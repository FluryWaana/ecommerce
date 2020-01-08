<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=25)
     */
    private $article_reference;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $article_designation;

    /**
     * @ORM\Column(type="float")
     */
    private $article_prix_ht;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $article_description_courte;

    /**
     * @ORM\Column(type="text")
     */
    private $article_description_longue;

    /**
     * @ORM\Column(type="integer")
     */
    private $article_minimum_stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $article_stock;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleCategorie", inversedBy="articles")
     * @ORM\JoinColumn(name="article_categorie_id", referencedColumnName="article_categorie_id", nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="article")
     */
    private $image_uri;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ArticleMeta", inversedBy="articles")
     * @JoinTable(name="article_avoir_meta",
     *      joinColumns={@ORM\JoinColumn(name="article_reference", referencedColumnName="article_reference")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="article_meta_id", referencedColumnName="article_meta_id")}
     * )
     */
    private $meta;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleAvoirPromotion", mappedBy="article")
     */
    private $hasPromotions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeAvoirArticle", mappedBy="article")
     */
    private $commandeAvoirArticles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fournisseur", mappedBy="articles")
     */
    private $fournisseurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleCaracteristique", mappedBy="article")
     */
    private $caracteristiques;

    public function __construct()
    {
        $this->image_uri = new ArrayCollection();
        $this->meta = new ArrayCollection();
        $this->hasPromotions = new ArrayCollection();
        $this->commandeAvoirArticles = new ArrayCollection();
        $this->fournisseurs = new ArrayCollection();
        $this->caracteristiques = new ArrayCollection();
    }

    public function getArticle_reference()
    {
        return $this->article_reference;
    }

    public function getArticleReference(): ?string
    {
        return $this->article_reference;
    }

    public function setArticleReference(string $article_reference): self
    {
        $this->article_reference = $article_reference;

        return $this;
    }

    public function getArticleDesignation(): ?string
    {
        return $this->article_designation;
    }

    public function setArticleDesignation(string $article_designation): self
    {
        $this->article_designation = $article_designation;

        return $this;
    }

    public function getArticlePrixHt(): ?float
    {
        return $this->article_prix_ht;
    }

    public function setArticlePrixHt(float $article_prix_ht): self
    {
        $this->article_prix_ht = $article_prix_ht;

        return $this;
    }

    public function getArticleDescriptionCourte(): ?string
    {
        return $this->article_description_courte;
    }

    public function setArticleDescriptionCourte(string $article_description_courte): self
    {
        $this->article_description_courte = $article_description_courte;

        return $this;
    }

    public function getArticleDescriptionLongue(): ?string
    {
        return $this->article_description_longue;
    }

    public function setArticleDescriptionLongue(string $article_description_longue): self
    {
        $this->article_description_longue = $article_description_longue;

        return $this;
    }

    public function getArticleMinimumStock(): ?int
    {
        return $this->article_minimum_stock;
    }

    public function setArticleMinimumStock(int $article_minimum_stock): self
    {
        $this->article_minimum_stock = $article_minimum_stock;

        return $this;
    }

    public function getArticleStock(): ?int
    {
        return $this->article_stock;
    }

    public function setArticleStock(int $article_stock): self
    {
        $this->article_stock = $article_stock;

        return $this;
    }

    public function getCategorie(): ?ArticleCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?ArticleCategorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImageUri(): Collection
    {
        return $this->image_uri;
    }

    public function addImageUri(Image $imageUri): self
    {
        if (!$this->image_uri->contains($imageUri)) {
            $this->image_uri[] = $imageUri;
            $imageUri->setArticle($this);
        }

        return $this;
    }

    public function removeImageUri(Image $imageUri): self
    {
        if ($this->image_uri->contains($imageUri)) {
            $this->image_uri->removeElement($imageUri);
            // set the owning side to null (unless already changed)
            if ($imageUri->getArticle() === $this) {
                $imageUri->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticleMeta[]
     */
    public function getMeta(): Collection
    {
        return $this->meta;
    }

    public function addMetum(ArticleMeta $metum): self
    {
        if (!$this->meta->contains($metum)) {
            $this->meta[] = $metum;
        }

        return $this;
    }

    public function removeMetum(ArticleMeta $metum): self
    {
        if ($this->meta->contains($metum)) {
            $this->meta->removeElement($metum);
        }

        return $this;
    }

    /**
     * @return Collection|ArticleAvoirPromotion[]
     */
    public function getHasPromotions(): Collection
    {
        return $this->hasPromotions;
    }

    public function addHasPromotion(ArticleAvoirPromotion $hasPromotion): self
    {
        if (!$this->hasPromotions->contains($hasPromotion)) {
            $this->hasPromotions[] = $hasPromotion;
            $hasPromotion->setArticle($this);
        }

        return $this;
    }

    public function removeHasPromotion(ArticleAvoirPromotion $hasPromotion): self
    {
        if ($this->hasPromotions->contains($hasPromotion)) {
            $this->hasPromotions->removeElement($hasPromotion);
            // set the owning side to null (unless already changed)
            if ($hasPromotion->getArticle() === $this) {
                $hasPromotion->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommandeAvoirArticle[]
     */
    public function getCommandeAvoirArticles(): Collection
    {
        return $this->commandeAvoirArticles;
    }

    public function addCommandeAvoirArticle(CommandeAvoirArticle $commandeAvoirArticle): self
    {
        if (!$this->commandeAvoirArticles->contains($commandeAvoirArticle)) {
            $this->commandeAvoirArticles[] = $commandeAvoirArticle;
            $commandeAvoirArticle->setArticle($this);
        }

        return $this;
    }

    public function removeCommandeAvoirArticle(CommandeAvoirArticle $commandeAvoirArticle): self
    {
        if ($this->commandeAvoirArticles->contains($commandeAvoirArticle)) {
            $this->commandeAvoirArticles->removeElement($commandeAvoirArticle);
            // set the owning side to null (unless already changed)
            if ($commandeAvoirArticle->getArticle() === $this) {
                $commandeAvoirArticle->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fournisseur[]
     */
    public function getFournisseurs(): Collection
    {
        return $this->fournisseurs;
    }

    public function addFournisseur(Fournisseur $fournisseur): self
    {
        if (!$this->fournisseurs->contains($fournisseur)) {
            $this->fournisseurs[] = $fournisseur;
            $fournisseur->addArticle($this);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): self
    {
        if ($this->fournisseurs->contains($fournisseur)) {
            $this->fournisseurs->removeElement($fournisseur);
            $fournisseur->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection|ArticleCaracteristique[]
     */
    public function getCaracteristiques(): Collection
    {
        return $this->caracteristiques;
    }

    public function addCaracteristique(ArticleCaracteristique $caracteristique): self
    {
        if (!$this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques[] = $caracteristique;
            $caracteristique->setArticle($this);
        }

        return $this;
    }

    public function removeCaracteristique(ArticleCaracteristique $caracteristique): self
    {
        if ($this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques->removeElement($caracteristique);
            // set the owning side to null (unless already changed)
            if ($caracteristique->getArticle() === $this) {
                $caracteristique->setArticle(null);
            }
        }

        return $this;
    }
}
