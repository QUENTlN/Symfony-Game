<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\RoomSettings;
use App\Form\AccountType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AccountController extends AbstractController
{
    /**
     * @Route("/profile",name="profile")
     * @IsGranted("ROLE_USER")
     */
    public function profile(Request $request, EntityManagerInterface $manager, FormFactoryInterface $factory): Response
    {
        $player = $this->getUser();

        $form = $factory->create(AccountType::class, $player);

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

    /**
     * @Route("/account", name="account")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, PaginatorInterface $paginator, GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();
        $player = $this->getUser();
        return $this->render('global/account.html.twig', [
            'player' => $player,
            'games' =>$games,
            'room_settings' => $paginator->paginate(
                $this->getDoctrine()->getRepository(RoomSettings::class)->findAllByPlayer($this->getUser()),
                $request->query->getInt('page', 1),
                12
            ),

        ]);
    }



}
