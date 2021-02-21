<?php

namespace App\Controller\Admin;

use App\Entity\RoomSettings;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Validator\Constraints\Date;

class RoomSettingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomSettings::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('idPlayer', 'Appartient à'),
            AssociationField::new('Room', 'Nombre de room associés'),
            AssociationField::new('subCategories','Nombre de mini-jeux')
                ->setFormTypeOption('disabled','disabled'),
            IntegerField::new('nbMaxPlayer', 'Nombre de joueurs max')
                ->setTextAlign('center'),
            BooleanField::new('showScore','score montré entre chaque round ?')
                ->setFormTypeOption('disabled','disabled'),
            BooleanField::new('oneAnswerOnly','Une seule réponse autorisée ?')
                ->setFormTypeOption('disabled','disabled'),
            IntegerField::new('numberRound','Nombre de round(s)')
                ->setTextAlign('center'),
            DateTimeField::new('createdAt','Date de création')
                ->setTextAlign('center')
                ->setFormTypeOption('disabled','disabled'),
            DateTimeField::new('deletedAt','Date de suppression')
                ->setTextAlign('center')
                ->setFormTypeOption('disabled','disabled'),
        ];
    }

}
