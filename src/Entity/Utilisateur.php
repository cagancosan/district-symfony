<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il y a déjà un compte existant avec cette adresse e-mail.')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Email(message: "Veuillez saisir une adresse e-mail valide.")]
    #[Assert\NotNull(message: "Veuillez saisir une adresse e-mail.")]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(max: 50, maxMessage: "Le nom ne peut excéder {{ limit }} caractères.")]
    #[Assert\NotNull(message: "Veuillez saisir un nom.")]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(max: 50, maxMessage: "Le prénom ne peut excéder {{ limit }} caractères.")]
    #[Assert\NotNull(message: "Veuillez saisir un prénom.")]
    private ?string $prenom = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(max: 20, maxMessage: "Le numéro de téléphone ne peut excéder {{ limit }} caractères.")]
    #[Assert\NotNull(message: "Veuillez saisir un numéro de téléphone.")]
    #[Assert\Regex('/^[0-9+\.\-]+$/', message: "Veuillez saisir un numéro de téléphone valide.")]
    private ?string $telephone = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(max: 50, maxMessage: "L'adresse ne peut excéder {{ limit }} caractères.")]
    #[Assert\NotNull(message: "Veuillez saisir une adresse.")]
    private ?string $adresse = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(max: 20, maxMessage: "Le code postal ne peut excéder {{ limit }} caractères.")]
    #[Assert\NotNull(message: "Veuillez saisir un code postal.")]
    #[Assert\Regex('/^[0-9\-]+$/', message: "Veuillez saisir un code postal valide.")]
    private ?string $cp = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(max: 50, maxMessage: "Le ville ne peut excéder {{ limit }} caractères.")]
    #[Assert\NotNull(message: "Veuillez saisir une ville.")]
    private ?string $ville = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Commande::class)]
    private Collection $commandes;

    #[ORM\Column(type: 'boolean')]
    private $verified = false;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUtilisateur() === $this) {
                $commande->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): static
    {
        $this->verified = $verified;

        return $this;
    }
}
