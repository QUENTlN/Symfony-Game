<?php

namespace App\Controller;

use App\Entity\RoomSettings;
use App\Form\RoomSettingsType;
use App\Repository\RoomSettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room_settings")
 */
class RoomSettingsController extends AbstractController
{
    /**
     * @Route("/", name="room_settings_index", methods={"GET"})
     */
    public function index(RoomSettingsRepository $roomSettingsRepository): Response
    {
        return $this->render('room_settings/index.html.twig', [
            'room_settings' => $roomSettingsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="room_settings_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $roomSetting = new RoomSettings();
        $form = $this->createForm(RoomSettingsType::class, $roomSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomSetting->setCreatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($roomSetting);
            $entityManager->flush();

            return $this->redirectToRoute('room_settings_index');
        }

        return $this->render('room_settings/new.html.twig', [
            'room_setting' => $roomSetting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_settings_show", methods={"GET"})
     */
    public function show(RoomSettings $roomSetting): Response
    {
        return $this->render('room_settings/show.html.twig', [
            'room_setting' => $roomSetting,
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

            return $this->redirectToRoute('room_settings_index');
        }

        return $this->render('room_settings/edit.html.twig', [
            'room_setting' => $roomSetting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_settings_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RoomSettings $roomSetting): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roomSetting->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($roomSetting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('room_settings_index');
    }
}
