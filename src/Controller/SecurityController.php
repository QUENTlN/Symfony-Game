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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Service\Mailer;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/sign_in", name="signIn")
     */
    public function signIn(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils -> getLastAuthenticationError();
        return $this->render('security/signIn.html.twig', [
            'error' => $error
        ]);
    }

    /**
     * @Route("/sign_up", name="signUp")
     */
    public function signUp(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, Mailer $mailer, TranslatorInterface $translator)
    {
        $player = new Player();

        $form = $this->createForm(RegistrationType::class, $player);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($player, $player->getPassword());
            $player->setPassword($hash);
            $manager->persist($player);
            $manager->flush();

            $mailer->sendRegistrationMail($player);

            $this->addFlash(
                'success',
                $translator->trans('accountCreated')
            );

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
