<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Room;
use App\Entity\RoomSettings;
use App\Repository\RoomSettingsRepository;
use App\Form\ConfigEnregistreType;
use App\Form\CreateRoomType;
use App\Form\ParamRoomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    /**
     * @Route("/create_room", name="createRoom" , methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $player = $this->getUser();
        $room = new Room();
        $roomSetting = new RoomSettings();
//        $room->setRoomSettings($roomSetting);
        $form_r = $this->createForm(CreateRoomType::class, $room);
        $form_c =  $this->createForm(ConfigEnregistreType::class, $roomSetting);

//        $form_p =  $this->createForm(ParamRoomType::class, $roomSetting);

//       $room->setName('parmoi');
//
//

//        if($request->isXmlHttpRequest()) {
////            dd($request);
//            $id = $request->request->get('id');
//            $info = $this->getDoctrine()->getRepository(RoomSettings::class)->find($id);
//            dd($info);
//        }

//        if($request->request->get('$id')!= null){
            dd($request);
            $id = $request->get('id');
            $info = $this->getDoctrine()->getRepository(RoomSettings::class)->find($id);
//        }
//        return new Response("Ce n'est pas une requête Ajax");
//        $id= $request->request->get('$id');
////          dd($request);
//        dd($id);
//        $id= $request->get('id');
//        dd($request);
//        $info = $this->getDoctrine()->getRepository(RoomSettings::class)->find($id);
//        dump($info);
        //dd($info);
        $this->getDoctrine()->getRepository(RoomSettings::class)->findAllByPlayer($this->getUser());
//        $name='coucou';
//        dd($name);
//        $roomSettings = $this->getDoctrine()->getRepository(RoomSettings::class)->findIdRoomSettingsByNameProfil($name);
//        $datas = array();
//        foreach ($roomSettings as $key => $roomSetting){
//            $datas[$key]['nbMaxPlayer'] = $roomSetting->getNbMaxPlayer();
//            //$datas[$key]['oneAnswerOnly'] = $roomSetting->get();
//            //$datas[$key]['showScore'] = $roomSetting->getNbMaxPlayer();
//            $datas[$key]['numberRound'] = $roomSetting->getNumberRound();
//            $datas[$key]['nbMaxPlayer'] = $roomSetting->getNbMaxPlayer();
//        }
//        return new JsonResponse($datas);
//        $info = $this->getDoctrine()->getRepository(RoomSettings::class)->findIdRoomSettingsByNameProfil($name);
//        dd($info);
//        $nbMaxPlayer=$info->getNbMaxPlayer();
//        $nbRound=$info->getNumberRound();
//        $subCategories=$info->getSubCategories();

//        dd($subCategories);
//        $roomSetting->setNbMaxPlayer('8');
//        $roomSetting->setNameProfil('coucou');
//        $roomSetting->setNumberRound('5');
//        $roomSetting->setCreatedAt(new \DateTime());
//        $idPlayer = $em->getRepository(Player::class)->findOneBy(['id' => $this->getUser()]);
//        $roomSetting->setIdPlayer($idPlayer);


        $room->setRoomSettings($roomSetting);
        //dd($room);



        $form_r->handleRequest($request);
        $form_c->handleRequest($request);
//        $form_p->handleRequest($request);


        //dd($form_r);
       // dump($room);

        if ($form_r->isSubmitted() && $form_r->isValid()) {
             $room->setCreatedAt(new \DateTime());
            // dump($room);


            //$this->getDoctrine()->getRepository(RoomSettings::class)->findNameProfilById($this->getUser());
           // $idPlayer = $em->getRepository(Player::class)->findOneBy(['id' => $this->getUser()]);
           // $room->setIdPlayer($idPlayer);
           // $room->setHost($idPlayer);




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('createRoom');
        }

        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();


        return $this->render('room/createRoom.html.twig', [
            'room' => $room,
            'room_setting' => $roomSetting,
//            'info' =>$info,
//            'nbMaxPlayer' => $nbMaxPlayer,
//            'nbRound' => $nbRound,
            'games' => $games,
            'player' => $player,
            'form_r' => $form_r->createView(),
            'form_c' => $form_c->createView(),
//            'form_p' => $form_p->createView(),

        ]);


    }
}
