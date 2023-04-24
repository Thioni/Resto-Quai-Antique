<?php

namespace App\Form;

use App\Entity\Dish;
use App\Entity\Photo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dish_id', HiddenType::class, ['mapped' => false])
            ->add('dish', EntityType::class, [
                'label' => "Plat",
                'class' => Dish::class,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('title', TextType::class, ['label' => "Titre"])
            ->add('path', TextType::class, ['label' => "Adresse d'hébergement", 'attr' => ['id' => 'photo_path']])
            ->add('selected', CheckboxType::class, [
                'label' => "Image par défaut",
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
          "data_class" => Photo::class
        ]);
    }
}