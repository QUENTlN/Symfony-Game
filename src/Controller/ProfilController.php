<?php

namespace App\Controller;

use App\Entity\RoomSettings;
use App\Form\RoomSettingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{

    /**
     * @Route("/room_settings", name="AddRoomSeetings")
     */
    public function AddRoomSeetings(Request $request, EntityManagerInterface $manager)
    {
        $roomSettings = new RoomSettings();

        $form = $this->createForm(RoomSettingsType::class, $roomSettings);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $roomSettings->setCreatedAt(new \DateTime());
            $manager->persist($roomSettings);
            $manager->flush();

            //return $this->redirectToRoute('account');
        }

        return $this->render('profil/roomSettings.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
