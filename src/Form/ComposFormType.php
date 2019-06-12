<?php

namespace App\Form;

use App\Entity\Compos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ComposFormType extends AbstractType
{
    /**
     * configure the label and placeholder of the type in the form
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
                    'value' => "/compos/REMPLACER.mp3"
                ]
            ])
            ->add('name', TextType::class, $this->configuration("nom", "nom de la composition"))
            ->add('caption', TextareaType::class, $this->configuration("légende", "légende de la composition"))
            ->add('image', TextType::class, [
                'label' => 'image représentante',
                'attr' => [
                    'value' => "/imagesCompos/REMPLACER.jpg"
                ]
            ])
            ->add('dateCreation', DateType::class, [
                'label' => "date de création de la composition",
                'years' => range(date('Y'), date('Y')-30)
            ])
            ->add('save', SubmitType::class, [
                'label' => "Publier la composition",
                'attr' => [
                    'class' => 'btn btn-primary mt-4 boutonForm'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compos::class,
        ]);
    }
}
