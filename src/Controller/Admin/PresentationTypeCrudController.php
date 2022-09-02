<?php

namespace App\Controller\Admin;

use App\Entity\PresentationType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PresentationTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PresentationType::class;
    }

    public function configureFields(string $pageName): iterable
        {
            return [
                IdField::new('id')->hideOnForm(),
                TextField::new('label'),
                DateTimeField::new('created')->hideOnForm(),
                DateTimeField::new('updated')->hideOnForm(),
                DateTimeField::new('content_changed')->hideOnForm(),
            ];
        }
}
