<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libCategory;

    /**
     * @ORM\ManyToOne(targetEntity=GuessThe::class, inversedBy="Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $guessThe;

    /**
     * @ORM\ManyToOne(targetEntity=Quiz::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Quiz;

    /**
     * @ORM\OneToMany(targetEntity=SubTheme::class, mappedBy="category")
     */
    private $SubTheme;

    public function __construct()
    {
        $this->SubTheme = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibCategory(): ?string
    {
        return $this->libCategory;
    }

    public function setLibCategory(string $libCategory): self
    {
        $this->libCategory = $libCategory;

        return $this;
    }

    public function getGuessThe(): ?GuessThe
    {
        return $this->guessThe;
    }

    public function setGuessThe(?GuessThe $guessThe): self
    {
        $this->guessThe = $guessThe;

        return $this;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->Quiz;
    }

    public function setQuiz(?Quiz $Quiz): self
    {
        $this->Quiz = $Quiz;

        return $this;
    }

    /**
     * @return Collection|SubTheme[]
     */
    public function getSubTheme(): Collection
    {
        return $this->SubTheme;
    }

    public function addSubTheme(SubTheme $subTheme): self
    {
        if (!$this->SubTheme->contains($subTheme)) {
            $this->SubTheme[] = $subTheme;
            $subTheme->setCategory($this);
        }

        return $this;
    }

    public function removeSubTheme(SubTheme $subTheme): self
    {
        if ($this->SubTheme->removeElement($subTheme)) {
            // set the owning side to null (unless already changed)
            if ($subTheme->getCategory() === $this) {
                $subTheme->setCategory(null);
            }
        }

        return $this;
    }
}
