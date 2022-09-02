<?php

namespace App\Controller\Admin;

use App\Entity\SubjectType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SubjectTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubjectType::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label'),
            AssociationField::new('subjects')->setFormTypeOptions([
                'by_reference' => false,
                'multiple' => true,
                'expanded' => false
            ]),
            DateTimeField::new('created')->hideOnForm(),
            DateTimeField::new('updated')->hideOnForm(),
            DateTimeField::new('content_changed')->hideOnForm(),
        ];
    }

}
