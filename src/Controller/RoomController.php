<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Entity\Player;
use App\Entity\Room;
use App\Entity\Game;
use App\Entity\RoomSettings;
use App\Entity\Score;
use App\Form\ConfigEnregistreType;
use App\Form\CreateRoomType;
use App\Repository\AnswerRepository;
use App\Repository\GuestRepository;
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
        $question = $questionRepository->findOneBy(['id' => $request->request->get('question')]);
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
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param ScoreRepository $scoreRepository
     * @param GuestRepository $guestRepository
     * @param QuestionRepository $questionRepository
     * @param RoomRepository $roomRepository
     * @param AnswerRepository $answerRepository
     * @return RedirectResponse
     */
    public function answerQuestion(MessageBusInterface $bus, EntityManagerInterface $entityManager, Request $request, ScoreRepository $scoreRepository, GuestRepository $guestRepository, QuestionRepository $questionRepository, RoomRepository $roomRepository, AnswerRepository $answerRepository): RedirectResponse
    {
        $question = $questionRepository->findOneBy(['id' => $request->request->get('question')]);
        $answer = $answerRepository->findOneBy(['question' => $question, 'textAnswer' => $request->request->get('message')]);
        if ($answer !== null) {
            $newPoints = $request->request->get('time');

            $body = json_encode([
                'type' => $request->request->get('type'),
                'isCorrect' => true,
                'message' => $request->request->get('message'),
                'idUser' => $request->request->get('idUser'),
                'newPoints' => $newPoints
            ]);
        } else {
            $body = json_encode([
                'type' => $request->request->get('type'),
                'isCorrest' => false,
                'message' => $request->request->get('message'),
                'idUser' => $request->request->get('idUser')
            ]);
        }
        $update = new Update(
            'http://mercure.hub/room/' . $request->request->get('idRoom'),
            $body
        );
        $bus->dispatch($update);
        if ($answer !== null) {
            $room = $roomRepository->findOneBy(['id' => $request->request->get('idRoom')]);
            $guest = $guestRepository->findOneBy(['id' => $request->request->get('idUser')]);
            $score = $scoreRepository->findOneBy(['guest' => $guest, 'room' => $room]);

            $score->setScore($score->getScore() + $newPoints);
            $entityManager->persist($score);
            $entityManager->flush();
        }
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
            if ($this->getUser() !== null) {
                $user = $this->getUser();
                dd($this->getUser(),$this->get('security.token_storage')->getToken()->isAuthenticated(),$this->container->get('security.token_storage')->getToken()->getUser());
            } else {
                $user = new Guest();
                $user->setPseudo("Guest" . substr(hexdec(uniqid('', true)), 0, 5));
                $manager->persist($user);
            }
            $score = $scoreRepository->findOneBy(['guest' => $user, 'room' => $id]);
            if ($score === null) {
                $score = new Score;
                $score->setRoom($room);
                if ($this->getUser() !== null) {
                    $score->setGuest($this->container->get('security.token_storage')->getToken()->getUser());
                } else {
                    $score->setGuest($user);
                }
                $score->setScore(0);
                $manager->persist($score);
            }
            $manager->flush();
            return $this->render('room/index.html.twig', [
                'room' => $room,
                'guest' => $user
            ]);
        }
    }


    /**
     * @Route("/create_room/{access}", name="createRoom" , methods={"GET","POST"})
     * @param Request $request
     * @param string $access
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, string $access, EntityManagerInterface $entityManager): Response
    {
        $room = new Room();
        if ($access === 'private') {
            $room->setIsPrivate(true);
        } else {
            $room->setIsPrivate(false);
        }

        $room->setName("Salon de " . $this->getUser()->getPseudo());
        $roomSetting = new RoomSettings();
        $form_c = $this->createForm(ConfigEnregistreType::class, $roomSetting);
        $form_r = $this->createForm(CreateRoomType::class, $room);


        $this->getDoctrine()->getRepository(RoomSettings::class)->findAllByPlayer($this->getUser());
        $form_r->handleRequest($request);
        $form_c->handleRequest($request);

        if ($form_r->isSubmitted() && $form_r->isValid()) {
            //$user = $this->get('security.context')->getToken()->getUser();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $roomSetting->setIdPlayer($user);
            $roomSetting->setOneAnswerOnly(false);
            $roomSetting->setShowScore(true);

            $room->setRoomSettings($roomSetting);
            $room->setHost($user);
            $roomSetting->setNameProfil(null);
            $entityManager->persist($room);
            $entityManager->flush();
            return $this->redirectToRoute('room', ['id' => $room->getId()]);
        }

        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();


        return $this->render('room/createRoom.html.twig', [
            'games' => $games,
            'form_c' => $form_c->createView(),
            'form_r' => $form_r->createView(),

        ]);
    }

    /**
     * @Route("/search_param", name="searchParam" , methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function searchParam(Request $request): Response
    {
        $id = $request->get('id');
        $roomSetting = $this->getDoctrine()->getRepository(RoomSettings::class)->find($id);
        $subCategories = $roomSetting->getSubCategories();
        $arraySubCat = array();
        foreach ($subCategories as $subCategory) {
            $arraySubCat[] = $subCategory->getId();
        }
        $response = new Response();
        $response->setContent(json_encode([
            'nbMaxPlayer' => $roomSetting->getNbMaxPlayer(),
            'nbRound' => $roomSetting->getNumberRound(),
            'subCategories' => $arraySubCat
        ]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }
}
