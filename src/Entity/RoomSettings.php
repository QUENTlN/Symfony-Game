<?php

namespace App\Entity;

use App\Repository\RoomSettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomSettingsRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class RoomSettings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbMaxPlayer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $showScore;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $oneAnswerOnly;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="roomSettings")
     */
    private $Room;

    /**
     * @ORM\ManyToMany(targetEntity=SubCategory::class, mappedBy="RoomSettings")
     */
    private $subCategories;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="roomSettings")
     */
    protected $game;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="roomSettings")
     */
    private $idPlayer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameProfil;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberRound;

    public function __construct()
    {
        $this->game = new ArrayCollection();
        $this->Room = new ArrayCollection();
        $this->subCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbMaxPlayer(): ?int
    {
        return $this->nbMaxPlayer;
    }

    public function setNbMaxPlayer(int $nbMaxPlayer): self
    {
        $this->nbMaxPlayer = $nbMaxPlayer;

        return $this;
    }

    public function getShowScore(): ?bool
    {
        return $this->showScore;
    }

    public function setShowScore(int $showScore): self
    {
        $this->showScore = $showScore;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getOneAnswerOnly(): ?bool
    {
        return $this->oneAnswerOnly;
    }

    public function setOneAnswerOnly(bool $oneAnswerOnly): self
    {
        $this->oneAnswerOnly = $oneAnswerOnly;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRoom(): Collection
    {
        return $this->Room;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->Room->contains($room)) {
            $this->Room[] = $room;
            $room->setRoomSettings($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->Room->removeElement($room)) {
            if ($room->getRoomSettings() === $this) {
                $room->setRoomSettings(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SubCategory[]
     */
    public function getSubCategories(): Collection
    {
        return $this->subCategories;
    }

    public function addSubCategory(SubCategory $subCategory): self
    {
        if (!$this->subCategories->contains($subCategory)) {
            $this->subCategories[] = $subCategory;
            $subCategory->addRoomSetting($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategory $subCategory): self
    {
        if ($this->subCategories->removeElement($subCategory)) {
            $subCategory->removeRoomSetting($this);
        }

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getIdPlayer(): ?Player
    {
        return $this->idPlayer;
    }

    public function setIdPlayer(?Player $idPlayer): self
    {
        $this->idPlayer = $idPlayer;

        return $this;
    }

    public function getNameProfil(): ?string
    {
        return $this->nameProfil;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    public function setNameProfil(?string $nameProfil): self
    {
        $this->nameProfil = $nameProfil;

        return $this;
    }

    public function getNumberRound(): ?int
    {
        return $this->numberRound;
    }

    public function setNumberRound(int $numberRound): self
    {
        $this->numberRound = $numberRound;

        return $this;
    }

    public function __toString(): string
    {
        return 'Id des paramètres de room sauvegardés : '.$this->getId();
    }
}
