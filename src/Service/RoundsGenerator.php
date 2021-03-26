<?php


namespace App\Service;


use App\Entity\Room;
use App\Entity\Round;
use App\Repository\QuestionRepository;

class RoundsGenerator
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function roundsGenerator(Room $room)
    {
        foreach($room->getRounds() as $round){
            $room->removeRound($round);
        }
        $nbRound = $room->getRoomSettings()->getNumberRound();
        $subCategories = $room->getRoomSettings()->getSubCategories();
        $questions = $this->questionRepository->findBySubCategories($subCategories);
        $questionsAlreadyUsed=[];
        for ($i = 1; $i <= $nbRound; $i++) {
            do{
                $chosenQuestion = $questions[random_int(0, count($questions) - 1)];
            }while(in_array($chosenQuestion, $questionsAlreadyUsed, true));
            $questionsAlreadyUsed[]=$chosenQuestion;
            $round = new Round();
            $round->setQuestion($chosenQuestion);
            $round->setIndexOrder($i);
            $room->addRound($round);
        }


    }

}