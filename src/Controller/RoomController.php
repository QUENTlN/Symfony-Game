<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    /**
     * @Route("/room", name="room")
     */
    public function index(): Response
    {
        return $this->render('room/index.html.twig', [
            'controller_name' => 'RoomController',
            true
        ]);
    }

    /**
     * @Route("/push", name="push", methods={"POST"})
     * @param PublisherInterface $publisher
     * @return Response
     */
    public function push(PublisherInterface $publisher): Response
    {
        $update = new Update(
            'http://example.com/books/1',
            json_encode(['status' => 'OutOfStock'])
        );

        // The Publisher service is an invokable object
        $publisher->__invoke($update);

        return $this->redirectToRoute("room");
    }
}
