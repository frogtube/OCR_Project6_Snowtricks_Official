<?php

namespace App\Form;


use App\Entity\Trick;
use App\Entity\User;
use App\Repository\TrickGroupRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password')
        /**
            ->add('trickGroup', EntityType::class, array(
                'class' => 'App\Entity\TrickGroup',
                'placeholder' => 'Choose a type of trick',
                'query_builder' => function(TrickGroupRepository $trickGroupRepository) {
                    return $trickGroupRepository->getTrickGroupsAlphabetically();
                }))
         **/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }

}