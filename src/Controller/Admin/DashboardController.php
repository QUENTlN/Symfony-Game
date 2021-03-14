<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Guest;
use App\Entity\Player;
use App\Entity\Question;
use App\Entity\Room;
use App\Entity\RoomSettings;
use App\Entity\SubCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        /*$route = $this->get(CrudUrlGenerator::class)->build();
        $url = $route->setController(PlayerCrudController::class)->generateUrl();
        return $this->redirect($url);
        */
        $accountsPlayer = $this->getDoctrine()->getRepository(Player::class)->findNumberPlayer();
        $numberGuest = $this->getDoctrine()->getRepository(Guest::class)->findNumberGuest();
        $numberRoomSettings = $this->getDoctrine()->getRepository(RoomSettings::class)->findNumberRoomSettings();
        $numberRoom = $this->getDoctrine()->getRepository(Room::class)->findNumberRoom();
        $numberRoomActive = $this->getDoctrine()->getRepository(Room::class)->findNumberRoomActive();

        return $this->render('admin/dashboard.html.twig', [
            'accountsPlayer' => $accountsPlayer,
            'numberGuest' => $numberGuest,
            'numberRoomSettings' => $numberRoomSettings,
            'numberRoom' => $numberRoom,
            'numberRoomActive' => $numberRoomActive
    ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Game');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
       return[
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Players', 'fas fa-address-book', Player::class),
            MenuItem::linkToCrud('Guests', 'far fa-address-book', Guest::class),
            MenuItem::linkToCrud('Question', 'far fa-question-circle', Question::class),
            MenuItem::linkToCrud('Rooms', 'fas fa-dice', Room::class),
            MenuItem::linkToCrud('Fiches de paramètres des rooms', 'fas fa-users-cog', RoomSettings::class),
            MenuItem::linkToCrud('Catégorie', 'fas fa-list', Category::class),
            MenuItem::linkToCrud('Sous-catégorie', 'fas fa-th-list', SubCategory::class),
            MenuItem::linkToRoute('Retourner sur le site', 'fas fa-house-user', 'home')

        ];
    }
}
