<?php

namespace App\Form;

use App\Entity\CompetenceAppWeb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CompetenceAppWebType extends AbstractType
{
    public function configuration ($placeholder)
    {
        return [
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->configuration("nommez une compétence"))
            ->add('description', TextareaType::class, $this->configuration("décrivez cette compétence"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CompetenceAppWeb::class,
        ]);
    }
}
