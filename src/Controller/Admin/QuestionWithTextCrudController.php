<?php

namespace App\Controller\Admin;

use App\Entity\QuestionWithText;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use SebastianBergmann\CodeCoverage\Report\Text;

class QuestionWithTextCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestionWithText::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('text'),
            TextField::new('status')
        ];
    }
}
