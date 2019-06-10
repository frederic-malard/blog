<?php

namespace App\Form;

use App\Entity\WebSite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class WebSiteType extends AbstractType
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
            ->add('name', TextType::class, $this->configuration("nom", "nom du site"))
            ->add('url', UrlType::class, [
                'label' => "url",
                'attr' => [
                    'placeholder' => "adresse réelle du site web",
                    'value' => "http://.fr"
                ]
            ])
            ->add('description', TextareaType::class, $this->configuration("description", "description du site"))
            ->add('image', TextType::class, [
                'label' => "image",
                'attr' => [
                    'placeholder' => "image pour représenter le site",
                    'value' => "/imagesSites/.jpg"
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => "Poster le site",
                'attr' => [
                    'class' => "btn btn-primary"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WebSite::class,
        ]);
    }
}
