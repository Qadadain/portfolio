<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Technology;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Uid\Ulid;

class TechnologyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Technology::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('identifier')->hideOnForm(),
            TextField::new('name'),
            ColorField::new('color'),
        ];
    }

}
