<?php

namespace App\Controller\Admin;

use App\Entity\ServiceList;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ServiceListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServiceList::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('category'),
            TextField::new('title'),
            NumberField::new('price'),
            NumberField::new('duration'),
            TextEditorField::new('description'),
        ];
    }

}
