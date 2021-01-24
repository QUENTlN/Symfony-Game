<?php

namespace App\Entity;

use App\Repository\RoomSettingsRepository;
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
}
