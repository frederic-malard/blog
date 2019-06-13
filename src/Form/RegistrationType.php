<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, $this->getConfiguration("login", "votre login (permettra de vous authentifier, identifiant) ..."))
            ->add('hash', PasswordType::class, $this->getConfiguration("mot de passe", "votre mot de passe..."))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("confirmation du mot de passe", "veuillez confirmer (réécrire) votre mot de passe..."))
            ->add('picture', UrlType::class, $this->getConfiguration("avatar", "l'url (chemin) de votre avatar (image de profile)", ['required' => false]))
            ->add('email', EmailType::class, $this->getConfiguration("email", "votre email"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
