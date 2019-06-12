<?php

namespace App\Form;

use App\Entity\Photos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PhotoType extends AbstractType
{
    /**
     * configuration of label and placeholder
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    public function configuration($label, $placeholder)
    {
        return [
            'label' => $label,
            'required' => false,
            'attr' => [
                'placeholder' => $placeholder
                ]
            ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class, [
                'label' => 'url',
                'attr' => [
                    'value' => "/photos/REMPLACER.jpg"
                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'nom (optionnel)',
                'required' => false,
                'attr' => [
                    'placeholder' => "nom de la photo"
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => 'slug',
                'required' => false,
                'attr' => [
                    'placeholder' => "rempli par défaut, sauf cas particulier, laisser ce champs vide"
                ]
            ])
            ->add('caption', TextareaType::class, $this->configuration('légende (optionnel)', "légende de la photo"))
            ->add('dateCreation', DateType::class, [
                'label' => 'date de création de la photo',
                'years' => range(date('Y'), date('Y')-30)
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Poster la photo',
                'attr' => [
                    'class' => 'btn btn-primary mt-4 boutonForm'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Photos::class,
        ]);
    }
}
