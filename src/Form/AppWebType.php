<?php

namespace App\Form;

use App\Entity\AppWeb;
use App\Form\CompetenceAppWebType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AppWebType extends AbstractType
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
            ->add('name', TextType::class, $this->configuration("nom", "nom de l'application web (choix libre et indépendant du nom du fichier)"))
            ->add('url', TextType::class, $this->configuration("url", "url du fichier js de l'app, dépourvu d'extension et de chemin, nom \"réel\" du fichier uniquement"))
            ->add('dateCreation', DateType::class, [
                'label' => "date de création de l'application web",
                'years' => range(date('Y'), date('Y')-30),
                'data' => new \DateTime('now')
            ])
            ->add('resume', TextareaType::class, $this->configuration("résumé", "résumé rapide de l'application web pour l'index"))
            ->add('description', TextareaType::class, $this->configuration("description", "description détaillée de l'application web"))
            ->add('image', TextType::class, [
                'label' => "image",
                'attr' => [
                    'value' => '/imagesApps/'
                ]
            ])
            ->add('competences', CollectionType::class, [
                'entry_type' => CompetenceAppWebType::class,
                'allow_add' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'repertorier l\'app web',
                'attr' => [
                    'class' => "btn btn-primary mt-3"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppWeb::class,
        ]);
    }
}
