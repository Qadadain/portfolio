<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\PostOldSlug;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostOldSlugCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PostOldSlug::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('identifier')->hideOnForm(),
            TextField::new('oldSlug'),
            AssociationField::new('post'),
        ];
    }
}
