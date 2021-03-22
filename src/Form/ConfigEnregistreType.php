<?php

namespace App\Form;

use App\Entity\RoomSettings;
use App\Entity\SubCategory;
use App\Repository\RoomSettingsRepository;
use App\Repository\SubCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigEnregistreType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameProfil', EntityType::class, [
                'class' =>RoomSettings::class,
                'query_builder' => function(RoomSettingsRepository $repo){
                    return $repo->findAllByPlayer($this->security->getUser());
                },
                'choice_label' => 'nameProfil',
            ])

            ->add('nbMaxPlayer', IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
//            ->add('oneAnswerOnly', CheckboxType::class, [
//                'required' => false,
//            ])
//            ->add('showScore', CheckboxType::class, [
//                'required' => false,
//            ])
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
