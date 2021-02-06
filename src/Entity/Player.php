<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *  fields= {"login"},
 *  message= "Email déjà utilisé, veuillez réessayer"
 * )
 */
class Player extends Guest implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit comporter 8 caractères minimum")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="player")
     */
    private $Question;

    /**
     * @ORM\OneToMany(targetEntity=RoomSettings::class, mappedBy="idPlayer")
     */
    private $roomSettings;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="host", orphanRemoval=true)
     */
    private $hostedRooms;


    public function __construct()
    {
        $this->Question = new ArrayCollection();
        $this->Answer = new ArrayCollection();
        $this->roomSettings = new ArrayCollection();
        $this->hostedRooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestion(): Collection
    {
        return $this->Question;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->Question->contains($question)) {
            $this->Question[] = $question;
            $question->setPlayer($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->Question->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getPlayer() === $this) {
                $question->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RoomSettings[]
     */
    public function getRoomSettings(): Collection
    {
        return $this->roomSettings;
    }

    public function addRoomSetting(RoomSettings $roomSetting): self
    {
        if (!$this->roomSettings->contains($roomSetting)) {
            $this->roomSettings[] = $roomSetting;
            $roomSetting->setHost($this);
        }

        return $this;
    }

    public function removeRoomSetting(RoomSettings $roomSetting): self
    {
        if ($this->roomSettings->removeElement($roomSetting)) {
            // set the owning side to null (unless already changed)
            if ($roomSetting->getHost() === $this) {
                $roomSetting->setHost(null);
            }
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setIsAdminValue(): void
    {
        $this->isAdmin = false;
    }

    /**
     * @return Collection|Room[]
     */
    public function getHostedRooms(): Collection
    {
        return $this->hostedRooms;
    }

    public function addHostedRoom(Room $hostedRoom): self
    {
        if (!$this->hostedRooms->contains($hostedRoom)) {
            $this->hostedRooms[] = $hostedRoom;
            $hostedRoom->setHost($this);
        }

        return $this;
    }

    public function removeHostedRoom(Room $hostedRoom): self
    {
        if ($this->hostedRooms->removeElement($hostedRoom)) {
            // set the owning side to null (unless already changed)
            if ($hostedRoom->getHost() === $this) {
                $hostedRoom->setHost(null);
            }
        }

        return $this;
    }

    public function getUsername(): string
    {
        return $this->login;
    }
}
