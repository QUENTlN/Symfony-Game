<?php

namespace App\Entity;

use App\Repository\SubCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubCategoryRepository::class)
 */
class SubCategory
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
    private $libSubCategory;

    /**
     * @ORM\ManyToMany(targetEntity=RoomSettings::class, inversedBy="subCategories")
     */
    private $RoomSettings;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="subCategory")
     */
    private $Question;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="subCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function __construct()
    {
        $this->RoomSettings = new ArrayCollection();
        $this->Question = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibSubCategory(): ?string
    {
        return $this->libSubCategory;
    }

    public function setLibSubCategory(string $libSubCategory): self
    {
        $this->libSubCategory = $libSubCategory;

        return $this;
    }

    /**
     * @return Collection|RoomSettings[]
     */
    public function getRoomSettings(): Collection
    {
        return $this->RoomSettings;
    }

    public function addRoomSetting(RoomSettings $roomSetting): self
    {
        if (!$this->RoomSettings->contains($roomSetting)) {
            $this->RoomSettings[] = $roomSetting;
        }

        return $this;
    }

    public function removeRoomSetting(RoomSettings $roomSetting): self
    {
        $this->RoomSettings->removeElement($roomSetting);

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestion(): Collection
    {
        return $this->Question;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->Question->contains($question)) {
            $this->Question[] = $question;
            $question->setSubCategory($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->Question->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getSubCategory() === $this) {
                $question->setSubCategory(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getLibSubCategory();
    }
}
