<?php

namespace App\Form;

use App\Entity\Prescrire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescrireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('medDepotlegal')
            ->add('tinCode')
            ->add('dosCode')
            ->add('prePosologie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prescrire::class,
        ]);
    }
}
