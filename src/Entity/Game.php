<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"game" = "Game", "quiz" = "Quiz", "guessThe" = "GuessThe"})
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
     * @ORM\OneToMany(targetEntity=SubCategory::class, mappedBy="Game")
     */
    private $subCategories;

    /**
     * @ORM\ManyToMany(targetEntity=RoomSettings::class, mappedBy="game")
     */
    private $roomSettings;

    public function __construct()
    {
        $this->subCategories = new ArrayCollection();
        $this->roomSettings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $subCategory->setGame($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategory $subCategory): self
    {
        if ($this->subCategories->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getGame() === $this) {
                $subCategory->setGame(null);
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

    public function addRoomSettings(RoomSettings $roomSettings): self
    {
        if (!$this->roomSettings->contains($roomSettings)) {
            $this->roomSettings[] = $roomSettings;
            $roomSettings->addGame($this);
        }

        return $this;
    }

    public function removeRoomSettings(RoomSettings $roomSettings): self
    {
        if ($this->roomSettings->removeElement($roomSettings)) {
            $roomSettings->removeGame($this);
        }

        return $this;
    }
}
