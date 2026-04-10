<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
#[UniqueEntity(fields: ['email'], message: 'Cet email est déjà utilisé par un autre utilisateur.')]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'ETUDIANT' => User::class, 
    'DIPLÔMÉ' => User::class, 
    'DIPLOME' => User::class, 
    'ADMIN' => Admin::class
])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z\s]+$/",
        message: "Le nom ne doit contenir que des lettres."
    )]
    protected ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z\s]+$/",
        message: "Le prénom ne doit contenir que des lettres."
    )]
    protected ?string $prenom = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "L'adresse email n'est pas valide.")]
    protected ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire.")]
    #[Assert\Length(
        min: 4,
        minMessage: "Le mot de passe doit faire au moins {{ limit }} caractères."
    )]
    protected ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    protected ?bool $actif = true;

    #[ORM\Column(name: 'LocalDateTime', type: 'datetime', nullable: true)]
    protected ?\DateTimeInterface $localDateTime = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $role = null;

    // --- GETTERS ET SETTERS ---

    public function getId(): ?int { return $this->id; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }

    public function isActif(): ?bool { return $this->actif; }
    public function setActif(bool $actif): self { $this->actif = $actif; return $this; }

    public function getLocalDateTime(): ?\DateTimeInterface { return $this->localDateTime; }
    public function setLocalDateTime(?\DateTimeInterface $localDateTime): self { $this->localDateTime = $localDateTime; return $this; }

    public function getRole(): ?string { return $this->role; }
    public function setRole(?string $role): self { $this->role = $role; return $this; }
}