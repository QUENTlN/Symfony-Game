<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use App\Entity\Player;
use App\Entity\Question;
use App\Entity\QuestionWithPicture;
use App\Entity\QuestionWithText;
use App\Entity\SubCategory;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    public function testQuestion()
    {
        $questionWithText = new QuestionWithText();
        $player = new Player();
        $player->setPseudo("Rolland")
            ->setLogin("Garos21");
        $category = new Category();
        $category ->setLibCategory("Sport");

        $subCategory = new SubCategory();
        $subCategory->setLibSubCategory("Foot")
            ->setCategory($category);

        $questionWithText->setText("Quelle est la capitale de l'Italie")
            ->setPlayer($player)
            ->setSubCategory($subCategory)
            ->setStatus(Question::STATUS["pending"]);


        $questionText = $questionWithText->getText();
        $questionTextSubCategory = $questionWithText->getSubCategory();
        $questionTextStatus = $questionWithText->getStatus();


        $this->assertEquals("Quelle est la capitale de l'Italie",$questionText);
        $this->assertEquals("Foot",$questionTextSubCategory);
        $this->assertEquals("pending",$questionTextStatus);

        $questionWithPicture = new QuestionWithPicture();
        $questionWithPicture->setLinkPicture("http://lorempixel.com/640/480/")
            ->setPlayer($player)
            ->setSubCategory($subCategory)
            ->setStatus(Question::STATUS["pending"]);

        $questionPictureLink = $questionWithPicture->getLinkPicture();
        $questionPictureSubCategory = $questionWithPicture->getSubCategory();
        $questionPictureStatus = $questionWithPicture->getStatus();

        $this->assertEquals("http://lorempixel.com/640/480/",$questionPictureLink);
        $this->assertEquals("Foot",$questionPictureSubCategory);
        $this->assertEquals("pending",$questionPictureStatus);

    }
}