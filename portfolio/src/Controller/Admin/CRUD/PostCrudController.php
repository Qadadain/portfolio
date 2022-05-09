<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('identifier')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('description'),
            TextEditorField::new('content'),
            DateTimeField::new('createAt'),
            DateTimeField::new('updateAt'),
            AssociationField::new('author'),
            AssociationField::new('technology'),
        ];
    }
}
