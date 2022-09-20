<?php

namespace App\Controller\Admin;

use App\Controller\Admin\CRUD\UserCrudController;
use App\Entity\Post;
use App\Entity\Tag;
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

        return $this->redirect($adminUrlGenerator->setController(crudControllerFqcn: UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Blog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud(label: 'User', icon: 'fas fa-list', entityFqcn: User::class);
        yield MenuItem::linkToCrud(label: 'Post', icon: 'fas fa-list', entityFqcn: Post::class);
        yield MenuItem::linkToCrud(label: 'Tag', icon: 'fas fa-list', entityFqcn: Tag::class);
    }
}
