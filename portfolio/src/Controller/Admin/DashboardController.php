<?php

namespace App\Controller\Admin;

use App\Controller\Admin\CRUD\UserCrudController;
use App\Entity\Post;
use App\Entity\Technology;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        // Option 1. Make your dashboard redirect to the same page for all users
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

public function configureDashboard(): Dashboard
{
    return Dashboard::new()
        ->setTitle('Blog');
}

public function configureMenuItems(): iterable
{
    yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
    yield MenuItem::linkToCrud('Technology', 'fas fa-list', Technology::class);
    yield MenuItem::linkToCrud('Post', 'fas fa-list', Post::class);
}

}
