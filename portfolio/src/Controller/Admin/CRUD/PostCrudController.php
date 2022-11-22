<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new(propertyName: 'identifier')->hideOnForm(),
            TextField::new(propertyName: 'title'),
            TextEditorField::new(propertyName: 'description')->hideOnIndex()->setFormType(formTypeFqcn: CKEditorType::class)->setColumns(cols: 9),
            TextEditorField::new(propertyName: 'content')->hideOnIndex()->setFormType(formTypeFqcn: CKEditorType::class)->setColumns(cols: 9),
            DateTimeField::new(propertyName: 'publishedAt'),
            DateTimeField::new(propertyName: 'updatedAt')->hideOnForm(),
            AssociationField::new(propertyName: 'tags'),
            AssociationField::new(propertyName: 'author'),
            SlugField::new(propertyName: 'slug')->setTargetFieldName(fieldName: 'title'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme(themePath: '@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}
