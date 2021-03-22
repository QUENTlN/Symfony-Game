<?php

namespace App\Controller;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\RoomSettings;
use App\Form\RoomSettingsType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
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
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, EntityManagerInterface $manager, FormFactoryInterface $factory, GameRepository $gameRepository): Response
    {
        $roomSetting = new RoomSettings();
        $form = $factory->create(RoomSettingsType::class, $roomSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idPlayer = $manager->getRepository(Player::class)->findOneBy(['id' => $this->getUser()->getId()]);
            $roomSetting->setIdPlayer($idPlayer);
            $roomSetting->setOneAnswerOnly(false);
            $roomSetting->setShowScore(true);

            $manager->persist($roomSetting);
            $manager->flush();

            return $this->redirectToRoute('account');
        }
        $games = $gameRepository->findAll();

        return $this->render('room_settings/new.html.twig', [
            'room_setting' => $roomSetting,
            'games' => $games,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="room_settings_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, RoomSettings $roomSetting, FormFactoryInterface $factory, EntityManager $manager): Response
    {
        $form = $factory->create(RoomSettingsType::class, $roomSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomSetting->setCreatedAt(new \DateTime());
            $manager->flush();


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
     * @IsGranted("ROLE_USER")
     */
    public function delete(RoomSettings $roomSetting, EntityManagerInterface $manager): RedirectResponse
    {
        $roomSetting->setDeletedAt(new \DateTime());
        $manager->flush();

        return $this->redirectToRoute('account');
    }




}
