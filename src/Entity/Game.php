<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=SubCategory::class, mappedBy="Game")
     */
    private $subCategories;

    /**
     * @ORM\ManyToMany(targetEntity=RoomSettings::class, mappedBy="Game")
     */
    private $ManyToMany;

    public function __construct()
    {
        $this->subCategories = new ArrayCollection();
        $this->ManyToMany = new ArrayCollection();
    }

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
    public function getManyToMany(): Collection
    {
        return $this->ManyToMany;
    }

    public function addManyToMany(RoomSettings $manyToMany): self
    {
        if (!$this->ManyToMany->contains($manyToMany)) {
            $this->ManyToMany[] = $manyToMany;
            $manyToMany->addGame($this);
        }

        return $this;
    }

    public function removeManyToMany(RoomSettings $manyToMany): self
    {
        if ($this->ManyToMany->removeElement($manyToMany)) {
            $manyToMany->removeGame($this);
        }

        return $this;
    }
}
