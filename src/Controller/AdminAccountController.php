<?php


namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("/admin/login", name="adminLogin")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('admin_account/formLoginAdmin.html.twig', [
            'error' => $error
        ]);

    }

    /**
     * @Route("/admin/logOut", name="adminlogOut")
     * @IsGranted("ROLE_ADMIN")
     */
    public function logOutAdmin()
    {
    }
}

