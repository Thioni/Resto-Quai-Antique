<?php

namespace App\Form;

use App\Entity\Allergen;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BookingType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ['label' => "Prénom"])
            ->add('lastname', TextType::class, ['label' => "Nom"])
            ->add('email', EmailType::class, ['label' => "Adresse mail"])
            ->add('seats',  IntegerType::class, [
                'label' => "Nombre de personnes",
                'attr' => [
                    'class' => 'text-center',
                    'min' => 0 
                ],
            ])
            ->add('timeslot', DateTimeType::class, [
                'label' => "Heure de réservation",
                'minutes' => range(0, 45, 15),
                'data' => new \DateTime(),
                "years" => range(date('Y'), date('Y') +1),                
            ])
            ->add('allergy', EntityType::class, [
                'class' => Allergen::class,
                'label' => "Allergies",
                'choice_label' => 'ingredient',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('comment', TextType::class, [
                'label' => "Commentaires",
                'required' => false,
                'attr' => [
                    'style' => 'height: 150px'
                ],
            ])
        ;
    }
    
};