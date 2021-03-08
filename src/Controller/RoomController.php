<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Room;
use App\Form\CreateRoomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    /**
     * @Route("/quentin", name="quentin")
     * @param PublisherInterface $publisher
     */
    public function quentin(PublisherInterface $publisher): Response
    {
        $update = new Update(
            'http://example.com/books/1',
            json_encode(['status' => 'OutOfStock'])
        );

        $publisher($update);

        return new Response('published!');
    }

    /**
     * @Route("/room", name="room")
     */
    public function index(): Response
    {
        return $this->render('room/index.html.twig', [
            'controller_name' => 'RoomController',
        ]);
    }


    /**
     * @Route("/create_room", name="createRoom", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $room = new Room();
        $form = $this->createForm(CreateRoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $room->setCreatedAt(new \DateTime());
            $idPlayer = $em->getRepository(Player::class)->findOneBy(['id' => $this->getUser()]);
            $room->setIdPlayer($idPlayer);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('createRoom');
        }


        return $this->render('room/createRoom.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }
}
