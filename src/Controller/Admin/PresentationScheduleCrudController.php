<?php

namespace App\Controller\Admin;

use App\Entity\PresentationSchedule;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PresentationScheduleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PresentationSchedule::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label'),
            DateField::new('held'),
            AssociationField::new('mainSubject'),
            AssociationField::new('referenceSubject'),
            AssociationField::new('presentationSubject'),
            AssociationField::new('presentationType'),
            AssociationField::new('tags'),
            DateTimeField::new('created')->hideOnForm(),
            DateTimeField::new('updated')->hideOnForm(),
            DateTimeField::new('content_changed')->hideOnForm(),
        ];
    }
}
