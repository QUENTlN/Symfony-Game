<?php

namespace App\Entity;

use App\Repository\GuessTheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuessTheRepository::class)
 */
class GuessThe extends Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="guessThe")
     */
    private $Category;

    public function __construct()
    {
        $this->Category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->Category->contains($category)) {
            $this->Category[] = $category;
            $category->setGuessThe($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->Category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getGuessThe() === $this) {
                $category->setGuessThe(null);
            }
        }

        return $this;
    }
}
