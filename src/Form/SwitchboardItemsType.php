<?php

namespace App\Form;

use App\Entity\SwitchboardItems;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SwitchboardItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('switchboardid')
            ->add('itemnumber')
            ->add('itemtext')
            ->add('command')
            ->add('argument')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SwitchboardItems::class,
        ]);
    }
}
