<?php

namespace App\Form;

use App\Entity\FichePedagogique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FichePedagogiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Semestre')
            ->add('EtatFiche')
            ->add('Date')
            ->add('DateValidation')
            ->add('Secretaire')
            ->add('Parcours')
            ->add('Etudiant')
            ->add('ueParcours')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FichePedagogique::class,
        ]);
    }
}
