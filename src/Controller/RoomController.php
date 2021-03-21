<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Room;
use App\Entity\RoomSettings;
use App\Entity\SubCategory;
use App\Repository\RoomSettingsRepository;
use App\Form\ConfigEnregistreType;
use App\Form\CreateRoomType;
use App\Repository\SubCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    /**
     * @Route("/create_room/{access}", name="createRoom" , methods={"GET","POST"})
     */
    public function new(Request $request, string $access, EntityManagerInterface $entityManager): Response
    {
        $room = new Room();
        if ($access == 'private') {
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
            $user=$this->container->get('security.token_storage')->getToken()->getUser();
            $roomSetting->setIdPlayer($user);
            $roomSetting->setOneAnswerOnly(false);
            $roomSetting->setShowScore(true);

            $room->setRoomSettings($roomSetting);
            $room->setHost($user);
            $roomSetting->setNameProfil(null);
            $entityManager->persist($room);
            $entityManager->flush();
            dd($room);
            return $this->redirectToRoute('room',['id'=> $room->getId()]);
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
