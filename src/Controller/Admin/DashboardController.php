<?php

namespace App\Controller\Admin;

use App\Entity\Blog;

use App\Entity\Booking;
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
        // set title for dashboard
        return Dashboard::new()
            ->setTitle('Hair salon');
    }

    public function configureMenuItems(): iterable
    {
        // set section
        yield MenuItem::section('Customers', 'fa fa-users');
        // set item in the section with name and icon
        yield MenuItem::linkToCrud('List of Clients', 'fas fa-user', User::class);

        yield MenuItem::section('Services', 'fas fa-store');
        yield MenuItem::linkToCrud('Category', 'fas fa-bars', Category::class);
        yield MenuItem::linkToCrud('Service List', 'fas fa-list', ServiceList::class);

        yield MenuItem::section('Appointments', 'far fa-address-card');
        yield MenuItem::linkToCrud('Booking', 'fas fa-image', Booking::class);


        yield MenuItem::section('Gallery', 'fas fa-photo-video');
        yield MenuItem::linkToCrud('My works', 'fas fa-image', Gallery::class);

        yield MenuItem::section('Blog', 'fab fa-blogger-b');
        yield MenuItem::linkToCrud('My posts', 'far fa-comment-alt', Blog::class);

        // add link to home
        yield MenuItem::linkToRoute('Home', 'fa fa-home', 'home');
        //add link to logout
        yield MenuItem::linkToLogout('Logout', 'fa fa-exit');










    }
}
