<?php

namespace App\Entity;

use App\Repository\RoomRepository;
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
     * @ORM\Column(type="integer")
     */
    private $idRoom;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $linkRoom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $finishedAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $idHostedPlayer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPrivate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRoom(): ?int
    {
        return $this->idRoom;
    }

    public function setIdRoom(int $idRoom): self
    {
        $this->idRoom = $idRoom;

        return $this;
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

    public function getIdHostedPlayer(): ?int
    {
        return $this->idHostedPlayer;
    }

    public function setIdHostedPlayer(int $idHostedPlayer): self
    {
        $this->idHostedPlayer = $idHostedPlayer;

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
}
