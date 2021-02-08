<?php

namespace App\Controller;

use App\Form\AccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/profile",name="profile")
     */
    public function profile(Request $request, EntityManagerInterface $manager): Response
    {
        $player = $this->getUser();

        $form = $this->createForm(AccountType::class, $player);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($player);
            $manager->flush();

            return $this->redirectToRoute('account');
        }
        return $this->render('account/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
