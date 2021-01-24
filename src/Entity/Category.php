<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
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
}
