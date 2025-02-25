<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Quel est votre adresse?',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse'
                ]
            ])
            ->add('firstname', TextType::class,[
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('company', TextType::class,[
                'label' => 'Quel est le nom de votre entreprise? (facultatif)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez le nom de votre entreprise'
                ]
            ])
            ->add('address', TextType::class,[
                'label' => 'Votre adresse',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse'
                ]
            ])
            ->add('codePostal', TextType::class,[
                'label' => 'Votre code postale',
                'attr' => [
                    'placeholder' => 'Entrez votre code postale'
                ]
            ])
            ->add('city', TextType::class,[
                'label' => 'Votre ville',
                'attr' => [
                    'placeholder' => 'Entrez le nom de votre ville'
                ]
            ])
            ->add('country', CountryType::class,[
                'label' => 'Votre pays',
                'placeholder' => 'Choisissez votre pays'
            ])
            ->add('phone', TextType::class,[
                'label' => 'Votre téléphone',
                'attr' => [
                    'placeholder' => 'Entrez le numéro de votre téléphone'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label'=> 'Ajouter une adresse',
                'attr' => [
                    'class' => 'btn btn-info btn-sm'
                ]
            ])
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
