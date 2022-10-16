<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new(propertyName: 'identifier')->hideOnForm(),
            EmailField::new(propertyName: 'email'),
            ArrayField::new(propertyName: 'roles'),
            TextField::new(propertyName: 'imageFile', label: 'Upload')
                ->setFormType(formTypeFqcn: VichImageType::class)
                ->onlyOnForms(),
            ImageField::new(propertyName: 'image', label: 'Fichier')
                ->setBasePath(path: '/user/')
                ->onlyOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle(pageName: 'index', title: 'Utilisateur')
            ->setSearchFields(['identifier', 'email', 'roles']);
    }
}
