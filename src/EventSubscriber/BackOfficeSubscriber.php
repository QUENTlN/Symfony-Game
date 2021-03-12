<?php
namespace App\EventSubscriber;


use App\Entity\Player;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Doctrine\ORM\EntityManagerInterface;

class BackOfficeSubscriber implements EventSubscriberInterface
{
    private $manager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->manager = $entityManagerInterface;
    }

    public static function getSubscribedEvents()
    {
        return[
            BeforeEntityPersistedEvent::class => ['addPlayer']
            ];
    }

    public function addPlayer(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Player)) {
            return;
        }
        $this->setPassword($entity);
    }

    public function setPassword(Player $player)
    {
        $password = $player->getPassword();
        $player->setPassword(password_hash($password, PASSWORD_BCRYPT));
        $this->manager->persist($player);
        $this->manager->flush();
    }
}
