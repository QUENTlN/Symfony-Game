<?php

namespace App\Entity;

use App\Repository\SubThemeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubThemeRepository::class)
 */
class SubTheme
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
    private $libSubTheme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibSubTheme(): ?string
    {
        return $this->libSubTheme;
    }

    public function setLibSubTheme(string $libSubTheme): self
    {
        $this->libSubTheme = $libSubTheme;

        return $this;
    }
}
