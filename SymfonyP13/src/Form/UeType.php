<?php

namespace App\Form;

use App\Entity\Ue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CodeApogee')
            ->add('Type')
            ->add('Libelle')
            ->add('ECTS')
            ->add('parcours')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ue::class,
        ]);
    }
}
