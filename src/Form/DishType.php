<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

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
        ;
    }

};