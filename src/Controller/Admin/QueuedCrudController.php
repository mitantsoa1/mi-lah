<?php

namespace App\Controller\Admin;

use App\Entity\Queued;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QueuedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Queued::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

    // public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
    //     if (!$entityInstance instanceof Queued) return;

    //     $entityInstance->setCreatedAt(new \DateTimeImmutable());

    //     parent::persistEntity($entityManager, $entityInstance); // parent pour avoir la methode persistEntity de AbstractCrudController
    // }

    // public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
    //     if (!$entityInstance instanceof Queued) return;

    //     $entityInstance->setUpdatedAt(new \DateTimeImmutable());

    //     parent::updateEntity($entityManager, $entityInstance);
    // }
}