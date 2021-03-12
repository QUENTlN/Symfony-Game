<?php

namespace App\Controller\Admin;

use App\Entity\Player;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Faker\Provider\Text;

class PlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Player::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('pseudo', 'Pseudo'),
            TextField::new('login','Email',),
            TextField::new('password', 'Mot de passe'),
            Field::new('isAdmin', 'Modérateur ?')
                ->setTextAlign('center'),
            //fait référence à la fonction getRoles
            ArrayField::new('Roles', 'Rôle(s)')
                ->onlyOnIndex(),
            AssociationField::new('hostedRooms', 'Nombre de room(s) hostée(s)')
                ->setTextAlign('center')
                ->setFormTypeOption('disabled', 'disabled'),
            AssociationField::new('roomSettings', 'Paramètres de room')
                ->setFormTypeOption('disabled', 'disabled' )
                ->setTextAlign('center')
        ];
    }

}
