<?php

namespace App\Controller;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\RoomSettings;
use App\Form\RoomSettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room_settings")
 */
class RoomSettingsController extends AbstractController
{

    /**
     * @Route("/new", name="room_settings_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $roomSetting = new RoomSettings();
        $form = $this->createForm(RoomSettingsType::class, $roomSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomSetting->setCreatedAt(new \DateTime());
            $idPlayer = $em->getRepository(Player::class)->findOneBy(['id' => $this->getUser()->getId()]);
            $roomSetting->setIdPlayer($idPlayer);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($roomSetting);
            $entityManager->flush();

            return $this->redirectToRoute('account');
        }
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();

        return $this->render('room_settings/new.html.twig', [
            'room_setting' => $roomSetting,
            'games' => $games,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="room_settings_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RoomSettings $roomSetting): Response
    {
        $form = $this->createForm(RoomSettingsType::class, $roomSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomSetting->setCreatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('account');
        }
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();

        return $this->render('room_settings/edit.html.twig', [
            'room_setting' => $roomSetting,
            'games' => $games,
            'form' => $form->createView(),

        ]);

    }


    /**
     * @Route("/{id}/delete", name="room_settings_delete")
     *
     */
    public function delete(RoomSettings $roomSetting): RedirectResponse
    {
        $roomSetting->setDeletedAt(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('account');
    }




}
