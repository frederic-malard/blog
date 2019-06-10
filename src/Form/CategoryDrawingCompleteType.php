<?php

namespace App\Form;

use App\Entity\CategorieDessin;
use App\Form\DrawingResumedType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CategoryDrawingCompleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "nom",
                'attr' => [
                    'placeholder' => "Entrez le nom d'une catégorie"
                ]
            ])
            ->add('representant', DrawingResumedType::class, [
                'label' => "représentant (entrez un des noms ci dessous)",
                'attr' => [
                    'placeholder' => "Entrez le nom d'un dessin (cf liste ci dessous, attention à ne pas vous tromper !"
                ]
            ])
            ->add('dessin', CollectionType::class, [
                'entry_type' => DrawingResumedType::class,
                'allow_add' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer la catégorie',
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategorieDessin::class,
        ]);
    }
}
