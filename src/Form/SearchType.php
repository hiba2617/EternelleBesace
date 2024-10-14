<?php

namespace App\Form;


use App\Entity\Category;
use App\Filter\Search;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('SearchName', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'votre recherche'
                ]
            
            ])
            ->add('SearchCategories', EntityType::class,[
                'label' => false,
                'required' => false,
                'class' => Category::class, 
                'multiple' => true,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn btn-light form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'methode' => 'GET',
            'crs_protection' => false,
            'allow_extra_fields' => true
        ]);
    }
    public function getBlockPrefix()
    {
        return'';
    }
}
