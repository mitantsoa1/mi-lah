<?php

namespace App\Controller\Admin;

use App\Entity\Operation;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OperationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Operation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('libelle', 'Libellé'),
            TextField::new('description', 'Description'),
            // TextField::new('type', 'Type')->setFormTypeOption(['attr' => ['placeholder' => '']]),
            TextField::new('type', 'Type')->setFormTypeOptions(['attr' => ['placeholder' => 'ESP|CHQ|...']]),
            AssociationField::new('fonction')
        ];
    }
}