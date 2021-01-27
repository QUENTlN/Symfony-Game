<?php

namespace App\Entity;

use App\Repository\RoomSettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomSettingsRepository::class)
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
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $idGameSettings;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="roomSettings")
     */
    private $Game;

    /**
     * @ORM\ManyToMany(targetEntity=SubTheme::class)
     */
    private $RoomSettings;

    public function __construct()
    {
        $this->Game = new ArrayCollection();
        $this->RoomSettings = new ArrayCollection();
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

    public function getShowScore(): ?int
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

    public function getIdGameSettings(): ?string
    {
        return $this->idGameSettings;
    }

    public function setIdGameSettings(?string $idGameSettings): self
    {
        $this->idGameSettings = $idGameSettings;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGame(): Collection
    {
        return $this->Game;
    }

    public function addGame(Game $game): self
    {
        if (!$this->Game->contains($game)) {
            $this->Game[] = $game;
            $game->setRoomSettings($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->Game->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getRoomSettings() === $this) {
                $game->setRoomSettings(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SubTheme[]
     */
    public function getRoomSettings(): Collection
    {
        return $this->RoomSettings;
    }

    public function addRoomSetting(SubTheme $roomSetting): self
    {
        if (!$this->RoomSettings->contains($roomSetting)) {
            $this->RoomSettings[] = $roomSetting;
        }

        return $this;
    }

    public function removeRoomSetting(SubTheme $roomSetting): self
    {
        $this->RoomSettings->removeElement($roomSetting);

        return $this;
    }
}
