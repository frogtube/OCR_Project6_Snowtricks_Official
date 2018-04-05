<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use App\Repository\TrickGroupRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('trickGroup', EntityType::class, array(
                'class' => 'App\Entity\TrickGroup',
                'required' => false,
                'placeholder' => 'Choose a type of trick',
                'query_builder' => function(TrickGroupRepository $trickGroupRepository) {
                    return $trickGroupRepository->getTrickGroupsAlphabetically();
                }))
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Trick::class
        ));
    }
}

