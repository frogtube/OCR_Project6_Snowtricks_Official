<?php

namespace App\Form;


use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Repository\TrickGroupRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('trickGroup', EntityType::class, array(
                'class' => 'App\Entity\TrickGroup',
                'placeholder' => 'Choose a type of trick',
                'query_builder' => function(TrickGroupRepository $trickGroupRepository) {
                    return $trickGroupRepository->getTrickGroupsAlphabetically();
                }))
            ->add('images', CollectionType::class, [


            ])
        ;
            /*
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $trick = $event->getData();
                $form = $event->getForm();
                if(!$trick->getImages()) {
                    $form->add('images', ImageType::class);
                }
            });
            */

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Trick::class
        ));
    }

}