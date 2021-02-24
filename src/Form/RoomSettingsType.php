<?php

namespace App\Form;

use App\Entity\RoomSettings;
use App\Repository\SubCategoryRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Game;
use App\Entity\Category;
use App\Entity\SubCategory;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('oneAnswerOnly', CheckboxType::class, [
                'required' => false,
            ])
            ->add('showScore', CheckboxType::class, [
                'required' => false,
            ])

            ->add('subCategories', EntityType::class, [
                'class' => SubCategory::class,
                'query_builder' => function (SubCategoryRepository $repo) {
                    return $repo->findAllQuery();
                },
                'by_reference' => false,
                'choice_label' => 'libSubCategory',
                'multiple' => 'true',
                'expanded' => 'true',
            ])

            ->add('nameProfil', TextType::class)
            ->add('numberRound', IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoomSettings::class,
        ]);
    }
}
