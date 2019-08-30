<?php

declare(strict_types=1);

namespace App\Admin;

use App\Form\Type\AddressType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class AddressAdmin extends AbstractAdmin
{
    public function __construct(string $code, string $class, string $baseControllerName)
    {
        parent::__construct($code, $class, $baseControllerName);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('street', TextType::class)
            ->add('flat_number', TextType::class)
            ->add('city', TextType::class)
            ->add('zip', TextType::class)
            ->add('id', HiddenType::class, [
                'required' => false
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('street');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('street')
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }
}