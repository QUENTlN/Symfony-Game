<?php

namespace App\Controller;

use App\Entity\ChangePassword;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordController extends AbstractController
{
    /**
     * @Route("/change_password", name="changePassword")
     */
    public function change(Request $request, UserInterface $user, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $change = new ChangePassword();

        $form = $this->createForm(ChangePasswordType::class, $change);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $change->getNewPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('profil/changePassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
