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
     * @ORM\Column(type="integer")
     */
    private $idAnswer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textAnswer;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="Answer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="relation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAnswer(): ?int
    {
        return $this->idAnswer;
    }

    public function setIdAnswer(int $idAnswer): self
    {
        $this->idAnswer = $idAnswer;

        return $this;
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

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

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
