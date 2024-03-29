<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Entity\Room;
use App\Entity\Game;
use App\Entity\RoomSettings;
use App\Entity\Score;
use App\Form\ConfigEnregistreType;
use App\Form\CreateRoomType;
use App\Repository\AnswerRepository;
use App\Repository\GameRepository;
use App\Repository\GuestRepository;
use App\Repository\QuestionRepository;
use App\Repository\RoomRepository;
use App\Repository\RoomSettingsRepository;
use App\Repository\RoundRepository;
use App\Repository\ScoreRepository;
use App\Service\RoundsGenerator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
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
        $answer = $answerRepository->findRightAnswer( $question, $request->request->get('message'));
        if ($answer > 0) {
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
        if ($answer > 0) {
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
            } else {
                $user = new Guest();
                $user->setPseudo("Guest" . random_int(0, 9999));
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
     * @param RoundsGenerator $roundsGenerator
     * @param FormFactoryInterface $factory
     * @param GameRepository $gameRepository
     * @return Response
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, string $access, EntityManagerInterface $entityManager, RoundsGenerator $roundsGenerator, FormFactoryInterface $factory, GameRepository $gameRepository): Response
    {
        $room = new Room();
        if ($access === 'private') {
            $room->setIsPrivate(true);
        } else {
            $room->setIsPrivate(false);
        }


        $room->setName("Salon de " . $this->getUser()->getPseudo());
        $roomSetting = new RoomSettings();
        $form_c = $factory->create(ConfigEnregistreType::class, $roomSetting);
        $form_r = $factory->create(CreateRoomType::class, $room);


        $form_r->handleRequest($request);
        $form_c->handleRequest($request);

        if ($form_r->isSubmitted() && $form_r->isValid()) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $roomSetting->setIdPlayer($user);
            $roomSetting->setOneAnswerOnly(false);
            $roomSetting->setShowScore(true);

            $room->setRoomSettings($roomSetting);
            $room->setHost($user);
            $roomSetting->setNameProfil(null);
            $roundsGenerator->roundsGenerator($room);
            $entityManager->persist($room);
            $entityManager->flush();
            return $this->redirectToRoute('room', ['id' => $room->getId()]);
        }

        $games = $gameRepository->findAll();


        return $this->render('room/createRoom.html.twig', [
            'games' => $games,
            'form_c' => $form_c->createView(),
            'form_r' => $form_r->createView(),

        ]);
    }

    /**
     * @Route("/search_param", name="searchParam" , methods={"GET","POST"})
     * @param Request $request
     * @param RoomSettingsRepository $roomSettingsRepository
     * @return Response
     */
    public function searchParam(Request $request, RoomSettingsRepository $roomSettingsRepository): Response
    {
        $id = $request->get('id');
        $roomSetting = $roomSettingsRepository->find($id);
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

    /**
     * @Route("/restart", name="restart")
     * @param MessageBusInterface $bus
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param RoundsGenerator $roundsGenerator
     * @param RoomRepository $roomRepository
     * @return RedirectResponse
     */
    public function restart(MessageBusInterface $bus, EntityManagerInterface $entityManager, Request $request, RoundsGenerator $roundsGenerator, RoomRepository $roomRepository): RedirectResponse
    {
        $room = $roomRepository->findOneBy(['id' => $request->request->get('room')]);
        $roundsGenerator->roundsGenerator($room);
        foreach ($room->getScores() as $score){
            $score->setScore(0);
            $entityManager->persist($score);
        }
        $entityManager->flush();
        $update = new Update(
            'http://mercure.hub/room/' . $request->request->get('room'),
            json_encode([
                'type' => 'startGame'
            ]));
        $bus->dispatch($update);
        return $this->redirectToRoute('room', ['id' => $request->request->get('room')]);
    }
}
