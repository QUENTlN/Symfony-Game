<?php

namespace App\Entity;

use App\Repository\QuestionWithPictureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionWithPictureRepository::class)
 */
class QuestionWithPicture extends Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkPicture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLinkPicture(): ?string
    {
        return $this->linkPicture;
    }

    public function setLinkPicture(string $linkPicture): self
    {
        $this->linkPicture = $linkPicture;

        return $this;
    }

    public function getType(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    public function __toString(): string
    {
        return $this->getLinkPicture();
    }

}
