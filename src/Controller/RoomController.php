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
//        define('DEMO_JWT', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOlsiKiJdfX0.soGvjZ9Yky1D3bA_W39iTv7PTPXi8FDE1HZgEl5N2ZE');
//
//        $postData = http_build_query([
//            'topic' => 'https://localhost/demo/books/1',
//            'data' => json_encode(['key' => 'updated value']),
//        ]);
//
//        echo file_get_contents('https://localhost:3000/.well-known/mercure', false, stream_context_create(['http' => [
//            'method'  => 'POST',
//            'header'  => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Bearer ".DEMO_JWT,
//            'content' => $postData,
//        ]]));
//        dd($publisher);
        $update = new Update(
            'http://example.com/books/1',
            json_encode(['status' => 'OutOfStock'])
        );

        // The Publisher service is an invokable object
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
