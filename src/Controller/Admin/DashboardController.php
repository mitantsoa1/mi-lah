<?php

namespace App\Controller\Admin;

use App\Entity\Agence;
use App\Entity\Fonction;
use App\Controller\Admin\AgenceCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\FonctionCrudController;
use App\Entity\Operation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[Route('/admin', name: 'admin.dashboard.')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        // return parent::index();

        /**
         * Pour rediriger le tableau de bord
         */

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(AgenceCrudController::class)->generateUrl());

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MI-LAH');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('User');
        yield MenuItem::subMenu('More', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Show User', 'fas fa-eye', User::class),
            MenuItem::linkToCrud('Add User', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::section('Agency');
        yield MenuItem::subMenu('More', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Show Agency', 'fas fa-eye', Agence::class),
            MenuItem::linkToCrud('Add Agency', 'fas fa-plus', Agence::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::section('Function');
        yield MenuItem::subMenu('More', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Show Function', 'fas fa-eye', Fonction::class),
            MenuItem::linkToCrud('Add Function', 'fas fa-plus', Fonction::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::section('Opération');
        yield MenuItem::subMenu('More', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Show Operation', 'fas fa-eye', Operation::class),
            MenuItem::linkToCrud('Add Operation', 'fas fa-plus', Operation::class)->setAction(Crud::PAGE_NEW)
        ]);
    }
}
