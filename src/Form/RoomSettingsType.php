<?php

namespace App\Form;

use App\Entity\RoomSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomSettingsType extends AbstractType
{
    const QUIZZ = 'quizz';
    const CULTURE = 'culture';
    const HISTOIRE = 'histoire';
    const GEOGRAPHIE = 'geographie';
    const DIVERTISSEMENT = 'divertissement';
    const CINEMA = 'cinema';
    const SERIE = 'serie';
    const JEUXVIDEOS = 'jeuxvideo';
    const SPORT = 'sport';
    const BASKET = 'basket';
    const FOOT = 'foot';
    const GUESSTHE = 'guessThe';
    const FILM = 'film';
    const SERIEE = 'serie';
    const JEUXVIDEOO = 'jeuxvideo';
    const ALBUM = 'album';
    const ANIME = 'anime';
    const ACTEUR = 'acteur';
    const ARTISTEMUSICAL = 'artistemusical';
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbMaxPlayer', IntegerType::class, array('attr' => array('min' => 1, 'max' => 20)))
            ->add('nameProfil',TextType::class)
            ->add('showScore', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non'  => false,
                ],
                'expanded'  => true,
                'multiple'  => false,

            ])
            //->add('showScore')
            //->add('createdAt')
           // ->add('oneAnswerOnly')
           // ->add('deletedAt')
           // ->add('subCategories')
            //->add('game')
            ->add('idPlayer')
            ->add('numberRound',IntegerType::class)
            ->add('subCategories', ChoiceType::class, [
                'choices' => [
                    'QUIZZ' => self::QUIZZ,
                    'Culture' => self::CULTURE,
                    'Histoire' => self::HISTOIRE,
                    'Géographie' => self::GEOGRAPHIE,
                    'Divertissement' => self::DIVERTISSEMENT,
                    'Cinéma' => self::CINEMA,
                    'Séries' => self::SERIE,
                    'Jeux vidéos' => self::JEUXVIDEOS,
                    'Sport'=> self::SPORT,
                    'Basket'=> self::BASKET,
                    'Foot'=> self::FOOT,
                    'GUESS THE'=> self::GUESSTHE,
                    'Film'=> self::FILM,
                    'Série'=> self::SERIEE,
                    'Jeux vidéos'=> self::JEUXVIDEOO,
                    'Album'=> self::ALBUM,
                    'Anime'=> self::ANIME,
                    'Acteur'=> self::ACTEUR,
                    'Artiste musical'=>self::ARTISTEMUSICAL,




                ],
                'expanded'  => true,
                'multiple'  => true,
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
