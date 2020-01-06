<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"user_email"}, message="Un compte existe déjà avec cette adresse email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $user_email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $user_password;

    /**
     * @var string La confirmation du mot de passe
     */
    private $confirm_password;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $user_nom;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $user_prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $user_date_naissance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $user_created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $user_updated_at;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $user_sexe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="user")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="user")
     */
    private $adresses;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->user_id;
    }

    public function getUser_Id()
    {
        return $this->user_id;
    }

    public function getUserEmail(): ?string
    {
        return $this->user_email;
    }

    public function setUserEmail(string $user_email): self
    {
        $this->user_email = $user_email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->user_email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->user_password;
    }

    public function getUserPassword(): string
    {
        return (string) $this->user_password;
    }

    public function setUserPassword(string $password): self
    {
        $this->user_password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserNom(): ?string
    {
        return $this->user_nom;
    }

    public function setUserNom(string $user_nom): self
    {
        $this->user_nom = $user_nom;

        return $this;
    }

    public function getUserPrenom(): ?string
    {
        return $this->user_prenom;
    }

    public function setUserPrenom(string $user_prenom): self
    {
        $this->user_prenom = $user_prenom;

        return $this;
    }

    public function getUserDateNaissance(): ?\DateTimeInterface
    {
        return $this->user_date_naissance;
    }

    public function setUserDateNaissance(?\DateTimeInterface $user_date_naissance): self
    {
        $this->user_date_naissance = $user_date_naissance;

        return $this;
    }

    public function getUserCreatedAt(): ?\DateTimeInterface
    {
        return $this->user_created_at;
    }

    public function setUserCreatedAt(\DateTimeInterface $user_created_at): self
    {
        $this->user_created_at = $user_created_at;

        return $this;
    }

    public function getUserUpdatedAt(): ?\DateTimeInterface
    {
        return $this->user_updated_at;
    }

    public function setUserUpdatedAt(?\DateTimeInterface $user_updated_at): self
    {
        $this->user_updated_at = $user_updated_at;

        return $this;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }

    public function getUserSexe(): ?string
    {
        return $this->user_sexe;
    }

    public function setUserSexe(string $user_sexe): self
    {
        $this->user_sexe = $user_sexe;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
            }
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
            $adress->setUser($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->contains($adress)) {
            $this->adresses->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getUser() === $this) {
                $adress->setUser(null);
            }
        }

        return $this;
    }


}
