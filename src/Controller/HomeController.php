<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Room;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $rooms = $this->getDoctrine()->getRepository(Room::class)->findBy([],['createdAt' => 'desc']);

        //dd($rooms);

        $rooms = $paginator->paginate(
            $rooms,
            $request->query->getInt('page', 1),
            10
        );

        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();

        return $this->render('home/index.html.twig', [
            'rooms' => $rooms,
            'games' => $games,
        ]);
    }
}
