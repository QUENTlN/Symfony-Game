<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('global/index.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }

    /**
     * @Route("/sign_in", name="signIn")
     */
    public function signIn(): Response
    {
        return $this->render('global/signIn.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }

    /**
     * @Route("/sign_up", name="signUp")
     */
    public function signUp(): Response
    {
        return $this->render('global/signUp.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }

    /**
     * @Route("/account", name="account")
     */
    public function account(): Response
    {
        return $this->render('global/account.html.twig', [
            'controller_name' => 'GlobalController',
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
}
