<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
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
            IdField::new(propertyName: 'id')->hideOnForm(),
            TextField::new(propertyName: 'title'),
            TextEditorField::new(propertyName: 'description'),
            TextEditorField::new(propertyName: 'content'),
            DateTimeField::new(propertyName: 'publishedAt'),
            DateTimeField::new(propertyName: 'updatedAt')->hideOnForm(),
            AssociationField::new(propertyName: 'tags'),
            AssociationField::new(propertyName: 'author'),
            SlugField::new(propertyName: 'slug')->setTargetFieldName(fieldName: 'title'),
        ];
    }

}
