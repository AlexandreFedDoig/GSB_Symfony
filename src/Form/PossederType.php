<?php

namespace App\Form;

use App\Entity\Posseder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PossederType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('praNum')
            ->add('speCode')
            ->add('posDiplome')
            ->add('posCoefprescription')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Posseder::class,
        ]);
    }
}
