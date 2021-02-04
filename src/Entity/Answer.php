<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textAnswer;


    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTextAnswer(): ?string
    {
        return $this->textAnswer;
    }

    public function setTextAnswer(?string $textAnswer): self
    {
        $this->textAnswer = $textAnswer;

        return $this;
    }


    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
