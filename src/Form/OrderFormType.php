<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'adresse_livraison',
                TextType::class,
                [
                    'label' => 'Adresse de livraison*',
                    'attr' => ['placeholder' => 'Saisissez une adresse de livraison']
                ]
            )
            ->add(
                'adresse_facturation',
                TextType::class,
                [
                    'label' => 'Adresse de facturation*',
                    'attr' => ['placeholder' => 'Saisissez une adresse de facturation']
                ]
            )
            ->add(
                'moyen_paiement',
                ChoiceType::class,
                [
                    'label' => 'Moyen de paiement*',
                    'choices' => [
                        'Choisissez un moyen de paiement' => null,
                        'Paiement au retrait' => 0,
                        'Visa' => 1,
                        'Mastercard' => 2,
                        'Paypal' => 3,
                    ]
                ]
            )
            ->add(
                'cgu',
                CheckboxType::class,
                [
                    'mapped' => false,
                    'label' => "J'accepte les CGU*",
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez accepter les CGU.',
                        ])
                    ],
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label' => 'Valider la commande',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
            'attr' => ['novalidate' => 'novalidate'],
        ]);
    }
}
