<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ContactRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    security: "is_granted('ROLE_ADMIN')"
)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull(message: "Veuillez saisir un objet.")]
    #[Groups(['read'])]
    private ?string $objet = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message: "Veuillez saisir une adresse e-mail valide.")]
    #[Assert\NotNull(message: "Veuillez saisir une adresse e-mail.")]
    #[Groups(['read'])]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read'])]
    private ?string $message = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }
}
