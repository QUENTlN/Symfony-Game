<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="room")
     * @Route("/home", name="home")
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
}
