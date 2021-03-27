<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libCategory', 'Nom de la catégorie')
                ->setTextAlign('center'),
            AssociationField::new('game','Jeu auquel est associé cette catégorie')
                ->setTextAlign('center'),
            AssociationField::new('subCategories','Sous catégories')
                ->setTextAlign('center'),

        ];
    }

}
