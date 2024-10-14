<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdatePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'label' => 'Votre adresse email',
                'disabled' => true
            ])
            ->add('firstname', TextType::class,[
                'label' => 'Votre prenom',
                'disabled' => true
                
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Votre nom',
                'disabled' => true   
            ])
            ->add('oldPassword', PasswordType::class,[
                'label' => 'Votre mot de passe actuel',
                'mapped' => false,
                'attr' => [
                    'placeholder'=> 'Votre mot de passe actuel'
                ]

            ])
            ->add('newPassword', RepeatedType::class,[
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent-être identiques',
                'label' => 'Nouveau mot de passe',
                'required' => true,
                'first_options' =>[
                    'label' => 'Mon nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Mon nouveau mot de passe'
                    ]
                    ],
                    'second_options' =>[
                        'label' => 'Confirmez votre nouveau mot de passe',
                        'attr' => [
                        'placeholder' => 'Confirmez votre nouveau mot de passe'
                        ]
                    ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Mettre à jour',
                'attr' => [
                        'class' => 'btn btn-lg btn-primary form-control'
                        
                        ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
