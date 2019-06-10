<?php

namespace App\Form;

use App\Entity\Texte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TexteType extends AbstractType
{
    private function configuration($label, $placeholder)
    {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->configuration("nom", "nom du texte"))
            ->add('contenu', TextareaType::class, $this->configuration("contenu", "le texte en lui même"))
            ->add('image', TextType::class, [
                'label' => 'image',
                'attr' => [
                    'value' => "/imagesTextes/"
                ]
            ])
            ->add('resume', TextareaType::class, $this->configuration("résumé", "résumé du texte"))
            ->add('dateCreation', DateType::class, [
                'label' => "date de création",
                'years' => range(date('Y'), date('Y')-30),
                'attr' => [
                    'placeholder' => "date de première écriture"
                ]
            ])
            ->add('datePublication', DateType::class, [
                'label' => "date de publication",
                'data' => new \DateTime("now"),
                'attr' => [
                    'placeholder' => "date de première publication de cette version"
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => "Publier le texte",
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Texte::class,
        ]);
    }
}
