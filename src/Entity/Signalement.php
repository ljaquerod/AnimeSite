<?php

namespace App\Entity;

use App\Repository\SignalementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SignalementRepository::class)]
class Signalement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $raison = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateSignalement = null;

    #[ORM\Column]
    private ?bool $statut = null;

    #[ORM\OneToOne(inversedBy: 'signalement', cascade: ['persist', 'remove'])]
    private ?Message $IdMessage = null;

    #[ORM\OneToOne(inversedBy: 'signalement', cascade: ['persist', 'remove'])]
    private ?Utilisateur $IdUtilisateur = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'signalements')]
    private Collection $IdModerateur;

    public function __construct()
    {
        $this->IdModerateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaison(): ?string
    {
        return $this->raison;
    }

    public function setRaison(string $raison): static
    {
        $this->raison = $raison;

        return $this;
    }

    public function getDateSignalement(): ?\DateTimeInterface
    {
        return $this->dateSignalement;
    }

    public function setDateSignalement(\DateTimeInterface $dateSignalement): static
    {
        $this->dateSignalement = $dateSignalement;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdMessage(): ?Message
    {
        return $this->IdMessage;
    }

    public function setIdMessage(?Message $IdMessage): static
    {
        $this->IdMessage = $IdMessage;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->IdUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $IdUtilisateur): static
    {
        $this->IdUtilisateur = $IdUtilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getIdModerateur(): Collection
    {
        return $this->IdModerateur;
    }

    public function addIdModerateur(Utilisateur $idModerateur): static
    {
        if (!$this->IdModerateur->contains($idModerateur)) {
            $this->IdModerateur->add($idModerateur);
        }

        return $this;
    }

    public function removeIdModerateur(Utilisateur $idModerateur): static
    {
        $this->IdModerateur->removeElement($idModerateur);

        return $this;
    }
}
