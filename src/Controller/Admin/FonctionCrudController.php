<?php

namespace App\Controller\Admin;

use App\Entity\Fonction;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FonctionCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return Fonction::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('code', 'Code fonction'),
            TextField::new('libelle', 'Libellé'),
            TextEditorField::new('description')->setRequired(false),
        ];
    }
}