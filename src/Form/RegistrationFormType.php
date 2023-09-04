<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Email*',
                    'attr' => ['placeholder' => 'Saisissez une adresse e-mail']
                ]
            )
            ->add(
                'plainPassword',
                PasswordType::class,
                [
                    'mapped' => false,
                    'label' => 'Mot de passe*',
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'Saisissez un mot de passe'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir un mot de passe.',
                        ]),
                        new Length([
                            'max' => 4096,
                        ]),
                    ],
                ]
            )
            ->add(
                'nom',
                TextType::class,
                [
                    'label' => 'Nom*',
                    'attr' => ['placeholder' => 'Saisissez un nom']
                ]
            )
            ->add(
                'prenom',
                TextType::class,
                [
                    'label' => 'Prénom*',
                    'attr' => ['placeholder' => 'Saisissez un prénom']
                ]
            )
            ->add(
                'telephone',
                TextType::class,
                [
                    'label' => 'Téléphone*',
                    'attr' => ['placeholder' => 'Saisissez un téléphone']
                ]
            )
            ->add(
                'adresse',
                TextType::class,
                [
                    'label' => 'Adresse*',
                    'attr' => ['placeholder' => 'Saisissez une adresse']
                ]
            )
            ->add(
                'cp',
                TextType::class,
                [
                    'label' => 'Code postal*',
                    'attr' => ['placeholder' => 'Saisissez un code postal']
                ]
            )
            ->add(
                'ville',
                TextType::class,
                [
                    'label' => 'Ville*',
                    'attr' => ['placeholder' => 'Saisissez une ville']
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label' => "Confirmer",
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
            'attr' => ['novalidate' => 'novalidate'],
        ]);
    }
}
