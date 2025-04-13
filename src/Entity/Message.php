<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenuMessage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePublication = null;

    #[ORM\Column]
    private ?int $likeCount = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?Topic $IdTopic = null;

    #[ORM\OneToOne(inversedBy: 'message', cascade: ['persist', 'remove'])]
    private ?Utilisateur $IdUtilisateur = null;

    #[ORM\OneToOne(mappedBy: 'IdMessage', cascade: ['persist', 'remove'])]
    private ?Signalement $signalement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuMessage(): ?string
    {
        return $this->contenuMessage;
    }

    public function setContenuMessage(string $contenuMessage): static
    {
        $this->contenuMessage = $contenuMessage;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): static
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getLikeCount(): ?int
    {
        return $this->likeCount;
    }

    public function setLikeCount(int $likeCount): static
    {
        $this->likeCount = $likeCount;

        return $this;
    }

    public function getIdTopic(): ?Topic
    {
        return $this->IdTopic;
    }

    public function setIdTopic(?Topic $IdTopic): static
    {
        $this->IdTopic = $IdTopic;

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

    public function getSignalement(): ?Signalement
    {
        return $this->signalement;
    }

    public function setSignalement(?Signalement $signalement): static
    {
        // unset the owning side of the relation if necessary
        if ($signalement === null && $this->signalement !== null) {
            $this->signalement->setIdMessage(null);
        }

        // set the owning side of the relation if necessary
        if ($signalement !== null && $signalement->getIdMessage() !== $this) {
            $signalement->setIdMessage($this);
        }

        $this->signalement = $signalement;

        return $this;
    }
}
