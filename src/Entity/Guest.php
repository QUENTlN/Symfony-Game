<?php

namespace App\Entity;

use App\Repository\GuestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuestRepository::class)
 */
class Guest
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
    private $idGuest;

    /**
     * @ORM\ManyToMany(targetEntity=Room::class, mappedBy="Guest")
     */
    private $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGuest(): ?int
    {
        return $this->idGuest;
    }

    public function setIdGuest(int $idGuest): self
    {
        $this->idGuest = $idGuest;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    private function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->addGuest($this);
        }

        return $this;
    }

    private function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            $room->removeGuest($this);
        }

        return $this;
    }
}
