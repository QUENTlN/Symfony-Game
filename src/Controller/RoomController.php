<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Room;
use App\Entity\Score;
use App\Form\CreateRoomType;
use App\Repository\AnswerRepository;
use App\Repository\QuestionRepository;
use App\Repository\RoomRepository;
use App\Repository\RoundRepository;
use App\Repository\ScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    /**
     * @Route("/quentin", name="quentin")
     * @param MessageBusInterface $bus
     * @param Request $request
     * @return RedirectResponse
     */
    public function quentin(MessageBusInterface $bus, Request $request): RedirectResponse
    {
        $update = new Update(
            'http://mercure.hub/room/' . $request->request->get('idRoom'),
            json_encode([
                'type' => $request->request->get('type'),
                'message' => $request->request->get('message'),
                'idUser' => $request->request->get('idUser'),
                'username' => $request->request->get('username')
            ])
        );
        $bus->dispatch($update);
        return $this->redirectToRoute('room', ['id' => $request->request->get('idRoom')]);
    }

    /**
     * @Route("/pushAnswer", name="pushAnswer")
     * @param MessageBusInterface $bus
     * @param AnswerRepository $answerRepository
     * @param QuestionRepository $questionRepository
     * @param Request $request
     * @return RedirectResponse
     */
    public function pushAnswer(MessageBusInterface $bus, AnswerRepository $answerRepository, QuestionRepository $questionRepository, Request $request): RedirectResponse
    {
        $question =$questionRepository->findOneBy(['id' => $request->request->get('question')]);
        $answer = $answerRepository->findOneBy(['question' => $question]);
        $update = new Update(
            'http://mercure.hub/room/' . $request->request->get('idRoom'),
            json_encode([
                'type' => 'pushAnswer',
                'answer' => $answer->getTextAnswer()
            ])
        );
        $bus->dispatch($update);
        return $this->redirectToRoute('room', ['id' => $request->request->get('idRoom')]);
    }

    /**
     * @Route("/answerQuestion", name="answerQuestion")
     * @param MessageBusInterface $bus
     * @param Request $request
     * @param QuestionRepository $questionRepository
     * @param RoomRepository $roomRepository
     * @param AnswerRepository $answerRepository
     * @return RedirectResponse
     */
    public function answerQuestion(MessageBusInterface $bus, Request $request, QuestionRepository $questionRepository, RoomRepository $roomRepository, AnswerRepository $answerRepository): RedirectResponse
    {
        $question = $questionRepository->findOneBy(['id' => $request->request->get('idQuestion')]);
        $answer = $answerRepository->findOneBy(['question' => $question]);
//        dd($answer);/*/
        if ($answer !== null) {
            $newPoints = $request->request->get('time');
            $room = $roomRepository->findOneBy(['id' => $request->request->get('idRoom')]);

            $update = new Update(
                'http://mercure.hub/room/' . $request->request->get('idRoom'),
                json_encode([
                    'type' => $request->request->get('type'),
                    'isCorrest' => true,
                    'message' => $request->request->get('message'),
                    'idUser' => $request->request->get('idUser'),
                    'newPoints' => $newPoints
                ])
            );
        } else {
            $update = new Update(
                'http://mercure.hub/room/' . $request->request->get('idRoom'),
                json_encode([
                    'type' => $request->request->get('type'),
                    'isCorrest' => false,
                    'message' => $request->request->get('message'),
                    'idUser' => $request->request->get('idUser')
                ])
            );
        }
        $bus->dispatch($update);
        return $this->redirectToRoute('room', ['id' => $request->request->get('idRoom')]);
    }

    /**
     * @Route("/nextQuestion", name="nextQuestion")
     * @param MessageBusInterface $bus
     * @param Request $request
     * @param RoundRepository $roundRepository
     * @param RoomRepository $roomRepository
     * @return RedirectResponse
     */
    public function nextQuestion(MessageBusInterface $bus, Request $request, RoundRepository $roundRepository, RoomRepository $roomRepository): RedirectResponse
    {

        $room = $roomRepository->findOneBy(['id' => $request->request->get('room')]);
        $round = $roundRepository->findOneBy(['room' => $room, 'indexOrder' => $request->request->get('current')]);
        $question = $round->getQuestion();
        if ($question->getType() === 'QuestionWithText') {
            $update = new Update(
                'http://mercure.hub/room/' . $request->request->get('room'),
                json_encode([
                    'type' => 'pushQuestion',
                    'game' => $question->getSubCategory()->getCategory()->getGame()->getName(),
                    'subcategory' => $question->getSubCategory()->getLibSubCategory(),
                    'text' => $question->getText(),
                    'idQuestion' => $question->getId(),
                    'questionType' => $question->getType()
                ])
            );
        } else {
            $update = new Update(
                'http://mercure.hub/room/' . $request->request->get('room'),
                json_encode([
                    'type' => 'pushQuestion',
                    'game' => $question->getSubCategory()->getCategory()->getGame()->getName(),
                    'subcategory' => $question->getSubCategory()->getLibSubCategory(),
                    'link' => $question->getLinkPicture(),
                    'idQuestion' => $question->getId(),
                    'questionType' => $question->getType()
                ])
            );
        }
        $bus->dispatch($update);
        return $this->redirectToRoute('room', ['id' => $request->request->get('room')]);
    }


    /**
     * @Route("/startGame/{id}", name="startGame", requirements={"id"="\d+"})
     * @param int $id
     * @param EntityManagerInterface $manager
     * @param RoomRepository $roomRepository
     * @param Request $request
     * @return RedirectResponse
     */
    public function startGame(int $id, EntityManagerInterface $manager, RoomRepository $roomRepository, Request $request): RedirectResponse
    {
        $room = $roomRepository->findOneBy(['id' => $id, 'finishedAt' => null]);
        $room->setStartedAt(new \DateTime());
        $manager->persist($room);
        $manager->flush();

        return $this->redirectToRoute('room', ['id' => $id]);
    }


    /**
     * @Route("/room/{id}", name="room", requirements={"id"="\d+"})
     * @param int $id
     * @param EntityManagerInterface $manager
     * @param RoomRepository $roomRepository
     * @param ScoreRepository $scoreRepository
     * @return Response
     */
    public function index(int $id, EntityManagerInterface $manager, RoomRepository $roomRepository, ScoreRepository $scoreRepository): Response
    {
        $room = $roomRepository->findOneBy(['id' => $id, 'finishedAt' => null]);
        if ($room === null) {
            //signal error
        } else {
            $score = $scoreRepository->findOneBy(['guest' => $this->getUser(), 'room' => $id]);
            if ($score === null) {
                $score = new Score;
                $score->setRoom($room);
                $score->setGuest($this->container->get('security.token_storage')->getToken()->getUser());
                $score->setScore(0);
                $manager->persist($score);
                $manager->flush();
            }
            return $this->render('room/index.html.twig', [
                'room' => $room,
            ]);
        }
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
