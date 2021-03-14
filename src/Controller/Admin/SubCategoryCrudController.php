<?php

namespace App\Controller\Admin;

use App\Entity\SubCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SubCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubCategory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libSubCategory','Nom de la sous-catégorie'),
            AssociationField::new('RoomSettings','Paramètres de rooms associés à cette sous-catégorie'),
            AssociationField::new('Question','Question'),
            AssociationField::new('category','Catégorie associée')


        ];
    }

}
