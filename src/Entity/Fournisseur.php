<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournisseurRepository")
 */
class Fournisseur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $fournisseur_reference;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $fournisseur_nom;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $fournisseur_telephone;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $fournisseur_email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fournisseur_site;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", inversedBy="fournisseurs")
     * @JoinTable(name="fournir",
     *      joinColumns={@ORM\JoinColumn(name="fournisseur_reference", referencedColumnName="fournisseur_reference")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="article_reference", referencedColumnName="article_reference")}
     * )
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="fournisseur")
     */
    private $adresses;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->fournisseur_reference;
    }

    public function getFournisseurReference(): ?int
    {
        return $this->fournisseur_reference;
    }

    public function getFournisseurNom(): ?string
    {
        return $this->fournisseur_nom;
    }

    public function setFournisseurNom(string $fournisseur_nom): self
    {
        $this->fournisseur_nom = $fournisseur_nom;

        return $this;
    }

    public function getFournisseurTelephone(): ?string
    {
        return $this->fournisseur_telephone;
    }

    public function setFournisseurTelephone(string $fournisseur_telephone): self
    {
        $this->fournisseur_telephone = $fournisseur_telephone;

        return $this;
    }

    public function getFournisseurEmail(): ?string
    {
        return $this->fournisseur_email;
    }

    public function setFournisseurEmail(string $fournisseur_email): self
    {
        $this->fournisseur_email = $fournisseur_email;

        return $this;
    }

    public function getFournisseurSite(): ?string
    {
        return $this->fournisseur_site;
    }

    public function setFournisseurSite(?string $fournisseur_site): self
    {
        $this->fournisseur_site = $fournisseur_site;

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
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setFournisseur($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->contains($adress)) {
            $this->adresses->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getFournisseur() === $this) {
                $adress->setFournisseur(null);
            }
        }

        return $this;
    }
}
