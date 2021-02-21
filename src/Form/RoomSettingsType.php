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
            ->add('subCategories', EntityType::class, [
                'class' => SubCategory::class,
                'query_builder' => function (SubCategoryRepository $repo) {
                    return $repo->findByGameQuery('Game');
                },
                'query_builder' => function (SubCategoryRepository $repo) {
                    return $repo->findByGameQuery('GuessThe');
                },
                'choice_label' => 'libSubCategory',
                'group_by' => ChoiceList::groupBy($this, 'category.libCategory'),
                'attr' => ['class' => 'form-control mb-2'],
                'multiple'     => 'true',
                'expanded'     => 'true',
            ])

            /*
            ->add('subCategories', EntityType::class, array(
                'class'        => SubCategory::class,
                'query_builder' => function (SubCategoryRepository $repo) {
                    return $repo->findByGameQuery('Quiz');
                },
                'choice_label' => 'libSubCategory',
                'group_by' => ChoiceList::groupBy($this, 'category.libCategory'),
                'multiple'     => 'true',
                'expanded'     => 'true',



            ))
            */

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
