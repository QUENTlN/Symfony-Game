<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $linkRoom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $finishedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPrivate;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="Room")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;



    /**
     * @ORM\ManyToOne(targetEntity=RoomSettings::class, inversedBy="Room")
     */
    private $roomSettings;

    /**
     * @ORM\OneToMany(targetEntity=Score::class, mappedBy="room", orphanRemoval=true)
     */
    private $scores;

    /**
     * @ORM\OneToMany(targetEntity=Round::class, mappedBy="room", orphanRemoval=true)
     */
    private $rounds;



    public function __construct()
    {
        $this->scores = new ArrayCollection();
        $this->rounds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getLinkRoom(): ?string
    {
        return $this->linkRoom;
    }

    public function setLinkRoom(string $linkRoom): self
    {
        $this->linkRoom = $linkRoom;

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

    public function getFinishedAt(): ?\DateTimeInterface
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(\DateTimeInterface $finishedAt): self
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getRoomSettings(): ?RoomSettings
    {
        return $this->roomSettings;
    }

    public function setRoomSettings(?RoomSettings $roomSettings): self
    {
        $this->roomSettings = $roomSettings;

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores[] = $score;
            $score->setRoom($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getRoom() === $this) {
                $score->setRoom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Round[]
     */
    public function getRounds(): Collection
    {
        return $this->rounds;
    }

    public function addRound(Round $round): self
    {
        if (!$this->rounds->contains($round)) {
            $this->rounds[] = $round;
            $round->setRoom($this);
        }

        return $this;
    }

    public function removeRound(Round $round): self
    {
        if ($this->rounds->removeElement($round)) {
            // set the owning side to null (unless already changed)
            if ($round->getRoom() === $this) {
                $round->setRoom(null);
            }
        }

        return $this;
    }


}
