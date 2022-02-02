<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,
            ['label' => 'Nom de la catégorie',
            'required' => false,
                'attr' => [
               'placeholder' => 'Ecrire ici le nom...'
                ]
            ])
            ->add('description',TextType::class,
            ['label' => 'Description de la catégorie',
            'required' => false,
                'attr' => [
               'placeholder' => 'Ecrire une description..'
                ]
            ])
            ->add('image', TextType::class,[
                'label'=> 'image de la catégorie',
                'attr' => [
                    'placeholder' => 'Ajouter une image ici'
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
