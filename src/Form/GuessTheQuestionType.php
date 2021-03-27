<?php

namespace App\Form;

use App\Entity\QuestionWithPicture;
use App\Entity\SubCategory;
use App\Repository\SubCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuessTheQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subCategory', EntityType::class, [
                'class' => SubCategory::class,
                'query_builder' => function (SubCategoryRepository $repo) {
                    return $repo->findByGameQuery('GuessThe');
                },
                'choice_label' => 'libSubCategory',
                'placeholder' => 'Choisir une catégorie',
                'attr' => ['class' => 'form-control mb-2'],
            ])
            ->add('linkPicture', FileType::class, [
                'attr' => ['class' => 'w-100 mb-2'],
            ])
            ->add('answers', CollectionType::class, [
                'entry_type' => AnswerType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => ['class' => 'btn btn-info btn-block btn-lg'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuestionWithPicture::class,
        ]);
    }
}
