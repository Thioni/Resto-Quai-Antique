<?php

namespace App\Form;

use App\Entity\Allergen;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

class BookingType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ['label' => "Prénom"])
            ->add('lastname', TextType::class, ['label' => "Nom"])
            ->add('email', TextType::class, ['label' => "Adresse mail"])
            ->add('seats', TextType::class, ['label' => "Nombre de personnes"])
            ->add('timeslot', TimeType::class, ['label' => "Heure de réservation"])
            ->add('allergy', EntityType::class, [
                'class' => Allergen::class,
                'label' => "Allergies",
                'choice_label' => 'ingredient',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('comment', TextType::class, ['label' => "Commentaires"])
        ;
    }
    
};