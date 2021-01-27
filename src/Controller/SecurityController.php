<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/sign_in", name="signIn")
     */
    public function signIn(): Response
    {
        return $this->render('security/signIn.html.twig');
    }

    /**
     * @Route("/sign_up", name="signUp")
     */
    public function signUp(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $player = new Player();

        $form = $this->createForm(RegistrationType::class, $player);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $player->setIsAdmin(false);
            $hash = $encoder->encodePassword($player, $player->getPassword());
            $player->setPassword($hash);
            $manager->persist($player);
            $manager->flush();

            return $this->redirectToRoute('signIn');
        }

        return $this->render('security/signUp.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/log_out", name="logOut")
     */
    public function logout(){}

}
