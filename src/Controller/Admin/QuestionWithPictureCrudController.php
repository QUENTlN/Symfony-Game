<?php

namespace App\Controller\Admin;

use App\Entity\QuestionWithPicture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestionWithPictureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestionWithPicture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('linkPicture'),
            TextField::new('status'),
        ];
    }

}
