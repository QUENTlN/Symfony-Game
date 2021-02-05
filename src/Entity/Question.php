<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"question" = "Question", "questionWithPicture" = "QuestionWithPicture"})
 */
class Question
{
    const STATUS = [
        "pending"=>"pending",
        "rejected"=>"rejected",
        "accepted"=>"accepted",
    ];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $textQuestion;


    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="Question")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="question")
     */
    private $answer;

    /**
     * @ORM\ManyToOne(targetEntity=SubCategory::class, inversedBy="Question")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subCategory;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Round::class, mappedBy="question", orphanRemoval=true)
     */
    private $rounds;

    public function __construct()
    {
        $this->answer = new ArrayCollection();
        $this->rounds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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


    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswer(): Collection
    {
        return $this->answer;
    }

    public function addRelation(Answer $answer): self
    {
        if (!$this->answer->contains($answer)) {
            $this->answer[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answer->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    public function getSubCategory(): ?SubCategory
    {
        return $this->subCategory;
    }

    public function setSubCategory(?SubCategory $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Round[]
     */
    public function getRounds(): Collection
    {
        return $this->rounds;
    }

    public function addRound(Round $round): self
    {
        if (!$this->rounds->contains($round)) {
            $this->rounds[] = $round;
            $round->setQuestion($this);
        }

        return $this;
    }

    public function removeRound(Round $round): self
    {
        if ($this->rounds->removeElement($round)) {
            // set the owning side to null (unless already changed)
            if ($round->getQuestion() === $this) {
                $round->setQuestion(null);
            }
        }

        return $this;
    }
}
