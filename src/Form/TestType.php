<?php

namespace App\Form;

use App\Entity\RoomSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbMaxPlayer')
            ->add('showScore')
            ->add('createdAt')
            ->add('oneAnswerOnly')
            ->add('deletedAt')
            ->add('subCategories')
            ->add('game')
            ->add('idPlayer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoomSettings::class,
        ]);
    }
}
