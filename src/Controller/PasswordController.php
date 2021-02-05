<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordController extends AbstractController
{
    /**
     * @Route("/forgot_password", name="forgotPassword")
     */
    public function forgot(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {

    }
}
