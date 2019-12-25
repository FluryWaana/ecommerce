<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitCategorieRepository")
 */
class ProduitCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $produit_categorie_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $produit_categorie_nom;

    public function getId(): ?int
    {
        return $this->produit_categorie_id;
    }

    public function getProduitCategorieNom(): ?string
    {
        return $this->produit_categorie_nom;
    }

    public function setProduitCategorieNom(string $produit_categorie_nom): self
    {
        $this->produit_categorie_nom = $produit_categorie_nom;

        return $this;
    }
}
