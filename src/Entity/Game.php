<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
    private $idGame;

    /**
     * @ORM\ManyToOne(targetEntity=RoomSettings::class, inversedBy="Game")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roomSettings;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGame(): ?int
    {
        return $this->idGame;
    }

    public function setIdGame(int $idGame): self
    {
        $this->idGame = $idGame;

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
}
