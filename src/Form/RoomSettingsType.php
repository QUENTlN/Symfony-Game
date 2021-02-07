<?php

namespace App\Form;

use App\Entity\RoomSettings;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbMaxPlayer', IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
            ->add('showScore')
           // ->add('createdAt')
            ->add('oneAnswerOnly')
          //  ->add('deletedAt')
            ->add('nameProfil',TextType::class)
            ->add('numberRound',IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
            //->add('subCategories')
            //->add('game')
            //->add('idPlayer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoomSettings::class,
        ]);
    }
}
