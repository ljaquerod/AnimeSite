<?php

namespace App\Entity;

use App\Repository\BibliothequeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BibliothequeRepository::class)]
class Bibliotheque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $publique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\Column(nullable: true)]
    private ?int $progression = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 1, scale: 1, nullable: true)]
    private ?string $notePersonnel = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAjout = null;

    #[ORM\OneToOne(inversedBy: 'bibliotheque', cascade: ['persist', 'remove'])]
    private ?Utilisateur $IdUtilisateur = null;

    /**
     * @var Collection<int, Anime>
     */
    #[ORM\OneToMany(targetEntity: Anime::class, mappedBy: 'bibliotheque')]
    private Collection $IdAnime;

    public function __construct()
    {
        $this->IdAnime = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPublique(): ?bool
    {
        return $this->publique;
    }

    public function setPublique(bool $publique): static
    {
        $this->publique = $publique;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getProgression(): ?int
    {
        return $this->progression;
    }

    public function setProgression(?int $progression): static
    {
        $this->progression = $progression;

        return $this;
    }

    public function getNotePersonnel(): ?string
    {
        return $this->notePersonnel;
    }

    public function setNotePersonnel(?string $notePersonnel): static
    {
        $this->notePersonnel = $notePersonnel;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): static
    {
        $this->dateAjout = $dateAjout;

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
     * @return Collection<int, Anime>
     */
    public function getIdAnime(): Collection
    {
        return $this->IdAnime;
    }

    public function addIdAnime(Anime $idAnime): static
    {
        if (!$this->IdAnime->contains($idAnime)) {
            $this->IdAnime->add($idAnime);
            $idAnime->setBibliotheque($this);
        }

        return $this;
    }

    public function removeIdAnime(Anime $idAnime): static
    {
        if ($this->IdAnime->removeElement($idAnime)) {
            // set the owning side to null (unless already changed)
            if ($idAnime->getBibliotheque() === $this) {
                $idAnime->setBibliotheque(null);
            }
        }

        return $this;
    }


}
