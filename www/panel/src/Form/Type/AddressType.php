<?php

namespace App\Form\Type;

use App\Entity\Address;
use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class, [
                'required' => false
            ])
            ->add('street', TextType::class)
            ->add('flat_number', TextType::class)
            ->add('city', TextType::class)
            ->add('zip', TextType::class)
            ->add('customer', HiddenType::class, [
                'data' => $this->requestStack->getCurrentRequest()->get('id')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Address::class,
        ));
    }
}