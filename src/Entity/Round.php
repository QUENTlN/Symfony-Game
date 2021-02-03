<?php

namespace App\Entity;

use App\Repository\RoundRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\QuestionRepository;

/**
 * @ORM\Entity(repositoryClass=RoundRepository::class)
 */
class Round
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
