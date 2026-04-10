<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvRepository::class)]
#[ORM\Table(name: 'cv')]
class Cv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(name: 'contenuOriginal', type: Types::TEXT)]
    private ?string $contenuOriginal = null;

    #[ORM\Column(name: 'contenuAmeliore', type: Types::TEXT, nullable: true)]
    private ?string $contenuAmeliore = null;

    #[ORM\Column(name: 'dateUpload', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateUpload = null;

    #[ORM\Column(name: 'nombreAmeliorations')]
    private ?int $nombreAmeliorations = 0;

    #[ORM\Column(name: 'estPublic')]
    private ?bool $estPublic = false;

    /**
     * Relation avec l'utilisateur. 
     * La colonne SQL s'appelle 'idUser' selon ta base.
     */
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'idUser', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    // --- GETTERS ET SETTERS ---

    public function getId(): ?int { return $this->id; }

    public function getTitre(): ?string { return $this->titre; }
    public function setTitre(string $titre): self { $this->titre = $titre; return $this; }

    public function getContenuOriginal(): ?string { return $this->contenuOriginal; }
    public function setContenuOriginal(string $contenuOriginal): self { $this->contenuOriginal = $contenuOriginal; return $this; }

    public function getContenuAmeliore(): ?string { return $this->contenuAmeliore; }
    public function setContenuAmeliore(?string $contenuAmeliore): self { $this->contenuAmeliore = $contenuAmeliore; return $this; }

    public function getDateUpload(): ?\DateTimeInterface { return $this->dateUpload; }
    public function setDateUpload(\DateTimeInterface $dateUpload): self { $this->dateUpload = $dateUpload; return $this; }

    public function getNombreAmeliorations(): ?int { return $this->nombreAmeliorations; }
    public function setNombreAmeliorations(int $nombreAmeliorations): self { $this->nombreAmeliorations = $nombreAmeliorations; return $this; }

    public function isEstPublic(): ?bool { return $this->estPublic; }
    public function setEstPublic(bool $estPublic): self { $this->estPublic = $estPublic; return $this; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(?User $user): self { $this->user = $user; return $this; }
}