<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $motDePasse = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $photoDeProfil = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    /**
     * @var Collection<int, Notification>
     */
    #[ORM\OneToMany(targetEntity: Notification::class, mappedBy: 'idUtilisateur')]
    private Collection $notifications;

    #[ORM\OneToOne(mappedBy: 'IdUtilisateur', cascade: ['persist', 'remove'])]
    private ?Bibliotheque $bibliotheque = null;

    #[ORM\OneToOne(mappedBy: 'IdUtilisateurCreation', cascade: ['persist', 'remove'])]
    private ?Topic $topic = null;

    #[ORM\OneToOne(mappedBy: 'IdUtilisateur', cascade: ['persist', 'remove'])]
    private ?Message $message = null;

    #[ORM\OneToOne(mappedBy: 'IdUtilisateur', cascade: ['persist', 'remove'])]
    private ?Signalement $signalement = null;

    /**
     * @var Collection<int, Signalement>
     */
    #[ORM\ManyToMany(targetEntity: Signalement::class, mappedBy: 'IdModerateur')]
    private Collection $signalements;

    public function __construct()
    {
        $this->notifications = new ArrayCollection();
        $this->signalements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

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

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): static
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getPhotoDeProfil(): ?string
    {
        return $this->photoDeProfil;
    }

    public function setPhotoDeProfil(?string $photoDeProfil): static
    {
        $this->photoDeProfil = $photoDeProfil;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getIdUtilisateur() === $this) {
                $notification->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    public function getBibliotheque(): ?Bibliotheque
    {
        return $this->bibliotheque;
    }

    public function setBibliotheque(?Bibliotheque $bibliotheque): static
    {
        // unset the owning side of the relation if necessary
        if ($bibliotheque === null && $this->bibliotheque !== null) {
            $this->bibliotheque->setIdUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($bibliotheque !== null && $bibliotheque->getIdUtilisateur() !== $this) {
            $bibliotheque->setIdUtilisateur($this);
        }

        $this->bibliotheque = $bibliotheque;

        return $this;
    }

    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    public function setTopic(?Topic $topic): static
    {
        // unset the owning side of the relation if necessary
        if ($topic === null && $this->topic !== null) {
            $this->topic->setIdUtilisateurCreation(null);
        }

        // set the owning side of the relation if necessary
        if ($topic !== null && $topic->getIdUtilisateurCreation() !== $this) {
            $topic->setIdUtilisateurCreation($this);
        }

        $this->topic = $topic;

        return $this;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function setMessage(?Message $message): static
    {
        // unset the owning side of the relation if necessary
        if ($message === null && $this->message !== null) {
            $this->message->setIdUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($message !== null && $message->getIdUtilisateur() !== $this) {
            $message->setIdUtilisateur($this);
        }

        $this->message = $message;

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
            $this->signalement->setIdUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($signalement !== null && $signalement->getIdUtilisateur() !== $this) {
            $signalement->setIdUtilisateur($this);
        }

        $this->signalement = $signalement;

        return $this;
    }

    /**
     * @return Collection<int, Signalement>
     */
    public function getSignalements(): Collection
    {
        return $this->signalements;
    }

    public function addSignalement(Signalement $signalement): static
    {
        if (!$this->signalements->contains($signalement)) {
            $this->signalements->add($signalement);
            $signalement->addIdModerateur($this);
        }

        return $this;
    }

    public function removeSignalement(Signalement $signalement): static
    {
        if ($this->signalements->removeElement($signalement)) {
            $signalement->removeIdModerateur($this);
        }

        return $this;
    }
}
