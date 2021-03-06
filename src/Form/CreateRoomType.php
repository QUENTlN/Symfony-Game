<?php

namespace App\Form;

use App\Entity\Room;
use App\Entity\RoomSettings;
use App\Repository\RoomSettingsRepository;
use App\Repository\SubCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;


class CreateRoomType extends AbstractType
{
//    public function getParent()
//    {
//        return RoomSettings::class;
//    }
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('roomSettings',ConfigEnregistreType::class,[
//                    'class' =>RoomSettings::class,
//                    'query_builder' => function(RoomSettingsRepository $repo){
//                        return $repo->findAllByPlayer($this->security->getUser());
//                    },
//                    'choice_label' => 'nameProfil',
//                    'multiple' => 'false',
//                    'expanded' => 'true',
//                ]
//
//            )
            //->add('name')
           // ->add('createdAt')
           // ->add('finishedAt')
           // ->add('isPrivate')
           /* ->add('roomSettings',EntityType::class,[
                'class' =>RoomSettings::class,
               'query_builder' => function(RoomSettingsRepository $repo){
                    return $repo->findAllByPlayer($this->security->getUser());
               },
                'choice_label' => 'nameProfil',
           ]

           )

            ->add('roomSettings', CollectionType::class, [
                'entry_type' => RoomSettingsType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
              // 'prototype' => true,
                'by_reference' => false,
            ])*/

//            ->add('roomSettings',RoomSettingsType::class)




            //->add('host')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
