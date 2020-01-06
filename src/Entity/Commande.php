<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $commande_reference;

    /**
     * @ORM\Column(type="datetime")
     */
    private $commande_date_creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $commande_date_paiement;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $commande_date_expedition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commandes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id",nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePaiement", inversedBy="type_paiement")
     * @ORM\JoinColumn(name="type_paiement_id", referencedColumnName="type_paiement_id",nullable=false)
     */
    private $typePaiement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeAvoirArticle", mappedBy="commande")
     */
    private $commandeAvoirArticles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", inversedBy="commande_facture")
     * @ORM\JoinColumn(name="commande_adresse_facture", referencedColumnName="adresse_id",nullable=false)
     */
    private $commande_adresse_facture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", inversedBy="commande_livraison")
     * @ORM\JoinColumn(name="commande_adresse_livraison", referencedColumnName="adresse_id",nullable=false)
     */
    private $commande_adresse_livraison;

    public function __construct()
    {
        $this->commandeAvoirArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->commande_reference;
    }

    public function getCommandeDateCreation(): ?\DateTimeInterface
    {
        return $this->commande_date_creation;
    }

    public function setCommandeDateCreation(\DateTimeInterface $commande_date_creation): self
    {
        $this->commande_date_creation = $commande_date_creation;

        return $this;
    }

    public function getCommandeDatePaiement(): ?\DateTimeInterface
    {
        return $this->commande_date_paiement;
    }

    public function setCommandeDatePaiement(?\DateTimeInterface $commande_date_paiement): self
    {
        $this->commande_date_paiement = $commande_date_paiement;

        return $this;
    }

    public function getCommandeDateExpedition(): ?\DateTimeInterface
    {
        return $this->commande_date_expedition;
    }

    public function setCommandeDateExpedition(?\DateTimeInterface $commande_date_expedition): self
    {
        $this->commande_date_expedition = $commande_date_expedition;

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

    public function getTypePaiement(): ?TypePaiement
    {
        return $this->typePaiement;
    }

    public function setTypePaiement(?TypePaiement $typePaiement): self
    {
        $this->typePaiement = $typePaiement;

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
            $commandeAvoirArticle->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeAvoirArticle(CommandeAvoirArticle $commandeAvoirArticle): self
    {
        if ($this->commandeAvoirArticles->contains($commandeAvoirArticle)) {
            $this->commandeAvoirArticles->removeElement($commandeAvoirArticle);
            // set the owning side to null (unless already changed)
            if ($commandeAvoirArticle->getCommande() === $this) {
                $commandeAvoirArticle->setCommande(null);
            }
        }

        return $this;
    }

    public function getCommandeAdresseFacture(): ?Adresse
    {
        return $this->commande_adresse_facture;
    }

    public function setCommandeAdresseFacture(?Adresse $commande_adresse_facture): self
    {
        $this->commande_adresse_facture = $commande_adresse_facture;

        return $this;
    }

    public function getCommandeAdresseLivraison(): ?Adresse
    {
        return $this->commande_adresse_livraison;
    }

    public function setCommandeAdresseLivraison(?Adresse $commande_adresse_livraison): self
    {
        $this->commande_adresse_livraison = $commande_adresse_livraison;

        return $this;
    }
}
