<?php

namespace App\Controller\Admin;

use App\Entity\Calendar;
use App\Entity\Category;
use App\Entity\Gallery;
use App\Entity\ServiceList;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ServiceListCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hair salon');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Customers', 'fa fa-users');
        yield MenuItem::linkToCrud('List of Clients', 'fas fa-user', User::class);

        yield MenuItem::section('Services', 'fas fa-store');
        yield MenuItem::linkToCrud('Category', 'fas fa-bars', Category::class);
        yield MenuItem::linkToCrud('Service List', 'fas fa-list', ServiceList::class);

        yield MenuItem::section('Appointments', 'far fa-address-card');
        yield MenuItem::linkToCrud('Calendar', 'fas fa-calendar-alt', Calendar::class);

        yield MenuItem::section('Gallery', 'fas fa-photo-video');
        yield MenuItem::linkToCrud('My works', 'fas fa-image', Gallery::class);








    }
}
