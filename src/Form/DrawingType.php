<?php

namespace App\Form;

use App\Entity\Dessin;
use App\Form\CategoryDrawingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class DrawingType extends AbstractType
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
                    'value' => "/dessins/REMPLACER.jpg"
                ]
            ])
            ->add('nom', TextType::class, $this->configuration('nom', "nom du dessin"))
            ->add('slug', TextType::class, [
                'label' => 'slug',
                'required' => false,
                'attr' => [
                    'placeholder' => "rempli par défaut, sauf cas particulier, laisser ce champs vide"
                ]
            ])
            ->add('caption', TextareaType::class, $this->configuration('légende', "légende du dessin"))
            ->add('dateCreation', DateType::class, [
                'label' => 'date de création du dessin',
                'years' => range(date('Y'), date('Y')-30)
            ])
            ->add('categorie', CollectionType::class, [
                'entry_type' => CategoryDrawingType::class,
                'allow_add' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Poster le dessin',
                'attr' => [
                    'class' => 'btn btn-success mt-4 boutonForm'
                ]
            ])
            //->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dessin::class,
        ]);
    }
}
