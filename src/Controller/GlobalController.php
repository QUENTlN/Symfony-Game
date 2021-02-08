<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlobalController extends AbstractController
{

    /**
     * @Route("/account", name="account")
     */
    public function account(): Response
    {
        $player = $this->getUser();
        return $this->render('global/account.html.twig', [
            'controller_name' => 'GlobalController',
            'player' => $player
        ]);
    }

    /**
     * @Route("/create_room", name="createRoom")
     */
    public function createRoom(): Response
    {
        return $this->render('global/createRoom.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }

    /**
     * @Route("/suggest_question", name="suggestQuestion")
     */
    public function suggestQuestion(): Response
    {
        return $this->render('global/suggestQuestion.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }

    /**
     * @Route("/accept_question", name="acceptQuestion")
     */
    public function acceptQuestion(): Response
    {
        return $this->render('global/acceptQuestion.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }
}
