<?php

namespace App\Tests\Entity;

use App\Entity\Player;
use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\QuestionWithPicture;
use App\Entity\QuestionWithText;
use App\Entity\SubCategory;
use PHPUnit\Framework\TestCase;

class AnswerTest extends TestCase
{
    public function testQuestion()
    {
        $answer = new Answer();
        $answer->setTextAnswer("Rome");

        $TextAnswer= $answer->getTextAnswer();
        $this->assertEquals("Rome", $TextAnswer);

    }
}