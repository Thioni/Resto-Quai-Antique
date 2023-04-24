<?php

namespace App\Form;

use App\Entity\Allergen;
use App\Entity\Dish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DishType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => "Nom"])
            ->add('description', TextType::class, [
                'label' => "Déscription",
                'attr' => ['style' => 'height: 150px; width: 100%'],                
            ])
            ->add('price', NumberType::class, ['label' => "Prix"])
            ->add('category', ChoiceType::class, [
                'label' => "Catégorie",
                'choices' => [
                    "Entrée" => "Entrée",
                    "Plat" => "Plat",
                    "Dessert" => "Dessert",
                    "Vin" => "Vin",
                    "Boisson" => "Boisson",
                ] 
            ])
            ->add('allergen', EntityType::class, [
                'class' => Allergen::class,
                'label' => "Allergènes",
                'choice_label' => 'ingredient',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
          "data_class" => Dish::class
        ]);
    }

};