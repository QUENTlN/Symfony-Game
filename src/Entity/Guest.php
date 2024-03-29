<?php

namespace App\Entity;

use App\Repository\GuestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuestRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"guest" = "Guest", "player" = "Player"})
 */
class Guest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $pseudo;

    /**
     * @ORM\OneToMany(targetEntity=Score::class, mappedBy="guest", orphanRemoval=true)
     */
    protected $scores;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Score $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setGuest($this);
        }

        return $this;
    }

    public function removeRoom(Score $room): self
    {
        if ($this->rooms->removeElement($room)) {
            if ($room->getGuest() === $this) {
                $room->setGuest(null);
            }
        }

        return $this;
    }
}
