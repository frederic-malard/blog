<?php

namespace App\Form;

use App\Entity\Dessin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class DrawingResumedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'nom',
                TextType::class,
                [
                    'label' => 'nom',
                    'attr' => [
                        'placeholder' => "nom du dessin, doit être dans la liste ci dessous. Attention : pas de faute !"
                    ]
                ]
            )
            ->add(
                'url',
                TextType::class
            )
            ->add(
                'caption',
                HiddenType::class
            )
            ->add(
                'dateCreation',
                null,
                [
                    'attr' => [
                        'style' => 'display:none;'
                    ]
                ]
            )
            ->add(
                'datePublication',
                null,
                [
                    'attr' => [
                        'style' => 'display:none;'
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dessin::class,
        ]);
    }
}
