<?php

namespace App\Form;

use App\Entity\Room;
use App\Entity\RoomSettings;
use App\Entity\SubCategory;
use App\Repository\RoomSettingsRepository;
use App\Repository\SubCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigEnregistreType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
//    public function getParent()
//    {
//        return RoomSettings::class;
//    }
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
//        ;
//            $builder->get('nameProfil')->addEventListener(
//                FormEvents::POST_SUBMIT,
//                function (FormEvent $event){
////                    dump($event->getForm());
////                    dump($event->getData());
//                    $form = $event->getForm();
//                    $form->getParent()->add('nbMaxPlayer',EntityType::class,[
//                        'class' =>RoomSettings::class,
//                        'mapped'=>false,
//                        'required'=>false,
//                        'choices'=>$form->getData()->getNbMaxPlayer()
//                    ]);

//                }
//            )

            ->add('nbMaxPlayer', IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
//            ->add('oneAnswerOnly', CheckboxType::class, [
//                'required' => false,
//            ])
//            ->add('showScore', CheckboxType::class, [
//                'required' => false,
//            ])
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
