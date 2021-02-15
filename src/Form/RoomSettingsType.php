<?php

namespace App\Form;

use App\Entity\RoomSettings;
use Doctrine\ORM\EntityRepository;
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
            // ->add('idPlayer',IntegerType::class)
            ->add('nbMaxPlayer', IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
            ->add('oneAnswerOnly', CheckboxType::class, [
                'required' => false,
            ])
            ->add('showScore', CheckboxType::class, [
                'required' => false,
            ])
            /*
                       ->add('game', EntityType::class, array(
                           'class'        => Game::class,
                           //'choice_value' => 'id',
                           'query_builder'=> function(EntityRepository $repository){
                               $query =$repository->createQueryBuilder('g')
                                   ->select('PARTIAL g.{id}');

                               return $query;
                           },
                           'choice_label' => function(Game $game){
                              return $game->getCategories();
                           },
                           'multiple'     => 'true',
                           'expanded'     => 'true',

                       ))

                   ->add('subCategories', EntityType::class, array(
                       'class'        => Category::class,
                       //'choice_value' => 'id',
                       'choice_label' => function(Category $category){
                           return $category->getLibCategory();
                       },
                       'multiple'     => 'true',
                       'expanded'     => 'true',

                   ))
           */
            ->add('subCategories', EntityType::class, array(
                'class'        => SubCategory::class,
                'choice_value' => 'id',
                'choice_label' => function(SubCategory $subCategory){
                    return $subCategory->getLibSubCategory();
                },
                'multiple'     => 'true',
                'expanded'     => 'true',
                'group_by'     =>function($choice,$key,$value){


                }


            ))


            // ->add('createdAt')
            //  ->add('deletedAt')
            ->add('nameProfil',TextType::class)
            ->add('numberRound',IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
            //->add('subCategories')
            //->add('game')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RoomSettings::class,
        ]);
    }
}
