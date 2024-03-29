<?php

namespace App\Controller;

use App\Entity\ChangePassword;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordController extends AbstractController
{
    /**
     * @Route("/change_password", name="changePassword")
     * @IsGranted("ROLE_USER")
     */
    public function change(Request $request, UserInterface $user, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, FormFactoryInterface $factory)
    {
        $change = new ChangePassword();

        $form = $factory->create(ChangePasswordType::class, $change);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $change->getNewPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('profilPassword/changePassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
