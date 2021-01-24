<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
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
    private $idQuestion;

    /**
     * @ORM\Column(type="text")
     */
    private $textQuestion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statusQuestion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdQuestion(): ?int
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(int $idQuestion): self
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }

    public function getTextQuestion(): ?string
    {
        return $this->textQuestion;
    }

    public function setTextQuestion(string $textQuestion): self
    {
        $this->textQuestion = $textQuestion;

        return $this;
    }

    public function getStatusQuestion(): ?bool
    {
        return $this->statusQuestion;
    }

    public function setStatusQuestion(bool $statusQuestion): self
    {
        $this->statusQuestion = $statusQuestion;

        return $this;
    }
}
