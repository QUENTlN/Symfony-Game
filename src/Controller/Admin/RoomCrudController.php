<?php

namespace App\Controller\Admin;

use App\Entity\Room;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Room::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('host','Host'),
            DateTimeField::new('createdAt','Date de création')
                ->setTextAlign('center')
                ->setFormTypeOption('disabled', 'disabled' ),
            DateTimeField::new('finishedAt','Date de fin de la partie')
                ->setTextAlign('center')
                ->setFormTypeOption('disabled', 'disabled' ),
            Field::new('isPrivate','Room privée ?')
        ];
    }

}
