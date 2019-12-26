<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypePaiementRepository")
 */
class TypePaiement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $type_paiement_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_paiement_nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="typePaiement")
     */
    private $type_paiement;

    public function __construct()
    {
        $this->type_paiement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->type_paiement_id;
    }

    public function getTypePaiementNom(): ?string
    {
        return $this->type_paiement_nom;
    }

    public function setTypePaiementNom(string $type_paiement_nom): self
    {
        $this->type_paiement_nom = $type_paiement_nom;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getTypePaiement(): Collection
    {
        return $this->type_paiement;
    }

    public function addTypePaiement(Commande $typePaiement): self
    {
        if (!$this->type_paiement->contains($typePaiement)) {
            $this->type_paiement[] = $typePaiement;
            $typePaiement->setTypePaiement($this);
        }

        return $this;
    }

    public function removeTypePaiement(Commande $typePaiement): self
    {
        if ($this->type_paiement->contains($typePaiement)) {
            $this->type_paiement->removeElement($typePaiement);
            // set the owning side to null (unless already changed)
            if ($typePaiement->getTypePaiement() === $this) {
                $typePaiement->setTypePaiement(null);
            }
        }

        return $this;
    }
}
