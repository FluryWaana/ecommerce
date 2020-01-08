<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresseRepository")
 */
class Adresse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $adresse_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_rue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse_complement;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $adresse_ville;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $adresse_code_postal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="adresses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="adresses")
     * @ORM\JoinColumn(name="fournisseur_reference", referencedColumnName="fournisseur_reference", nullable=true)
     */
    private $fournisseur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="commande_adresse_facture")
     */
    private $commande_facture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="commande_adresse_livraison")
     */
    private $commande_livraison;

    public function __construct()
    {
        $this->commande_facture     = new ArrayCollection();
        $this->commande_livraison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->adresse_id;
    }

    public function getAdresseRue(): ?string
    {
        return $this->adresse_rue;
    }

    public function setAdresseRue(string $adresse_rue): self
    {
        $this->adresse_rue = $adresse_rue;

        return $this;
    }

    public function getAdresseComplement(): ?string
    {
        return $this->adresse_complement;
    }

    public function setAdresseComplement(string $adresse_complement): self
    {
        $this->adresse_complement = $adresse_complement;

        return $this;
    }

    public function getAdresseVille(): ?string
    {
        return $this->adresse_ville;
    }

    public function setAdresseVille(string $adresse_ville): self
    {
        $this->adresse_ville = $adresse_ville;

        return $this;
    }

    public function getAdresseCodePostal(): ?string
    {
        return $this->adresse_code_postal;
    }

    public function setAdresseCodePostal(string $adresse_code_postal): self
    {
        $this->adresse_code_postal = $adresse_code_postal;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandeFacture(): Collection
    {
        return $this->commande_facture;
    }

    public function addCommandeFacture(Commande $commande): self
    {
        if (!$this->commande_facture->contains($commande)) {
            $this->commande_facture[] = $commande;
            $commande->setCommandeAdresseFacture($this);
        }

        return $this;
    }

    public function removeCommandeFacture(Commande $commande): self
    {
        if ($this->commande_facture->contains($commande)) {
            $this->commande_facture->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getCommandeAdresseFacture() === $this) {
                $commande->setCommandeAdresseFacture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandeLivraison(): Collection
    {
        return $this->commande_livraison;
    }

    public function addCommandeLivraison(Commande $commande): self
    {
        if (!$this->commande_livraison->contains($commande)) {
            $this->commande_livraison[] = $commande;
            $commande->setCommandeAdresseFacture($this);
        }

        return $this;
    }

    public function removeCommandeLivraison(Commande $commande): self
    {
        if ($this->commande_livraison->contains($commande)) {
            $this->commande_livraison->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getCommandeAdresseFacture() === $this) {
                $commande->setCommandeAdresseFacture(null);
            }
        }

        return $this;
    }
}
