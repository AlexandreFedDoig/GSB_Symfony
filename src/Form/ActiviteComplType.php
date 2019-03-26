<?php

namespace App\Form;

use App\Entity\ActiviteCompl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteComplType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('acDate')
            ->add('acLieu')
            ->add('acTheme')
            ->add('acMotif')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActiviteCompl::class,
        ]);
    }
}
