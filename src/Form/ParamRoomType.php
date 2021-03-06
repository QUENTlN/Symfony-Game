<?php

namespace App\Form;

use App\Entity\RoomSettings;
use App\Entity\SubCategory;
use App\Repository\SubCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParamRoomType extends AbstractType
{
//    public function getParent()
//    {
//        return RoomSettings::class;
//    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
//            ->add('nbMaxPlayer')
//            ->add('showScore')
//            ->add('createdAt')
//            ->add('oneAnswerOnly')
//            ->add('deletedAt')
//            ->add('nameProfil')
//            ->add('numberRound')
//            ->add('subCategories')
//            ->add('game')
//            ->add('idPlayer')
            ->add('nbMaxPlayer', IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
            ->add('oneAnswerOnly', CheckboxType::class, [
                'required' => false,
            ])
            ->add('showScore', CheckboxType::class, [
                'required' => false,
            ])
//            add('createdAt')
//            ->add('deletedAt')
            ->add('numberRound',IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoomSettings::class,
        ]);
    }
}
