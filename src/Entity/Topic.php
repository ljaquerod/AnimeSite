<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopicRepository::class)]
class Topic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenuMessage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\ManyToOne(inversedBy: 'topics')]
    private ?Categorie $IdCategorie = null;

    #[ORM\OneToOne(inversedBy: 'topic', cascade: ['persist', 'remove'])]
    private ?Utilisateur $IdUtilisateurCreation = null;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'IdTopic')]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->IdCategorie;
    }

    public function setIdCategorie(?Categorie $IdCategorie): static
    {
        $this->IdCategorie = $IdCategorie;

        return $this;
    }

    public function getIdUtilisateurCreation(): ?Utilisateur
    {
        return $this->IdUtilisateurCreation;
    }

    public function setIdUtilisateurCreation(?Utilisateur $IdUtilisateurCreation): static
    {
        $this->IdUtilisateurCreation = $IdUtilisateurCreation;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setIdTopic($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getIdTopic() === $this) {
                $message->setIdTopic(null);
            }
        }

        return $this;
    }
}
