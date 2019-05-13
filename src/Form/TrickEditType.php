<?php

namespace App\Form;

use App\Entity\Trick;
use App\Subscriber\EditTrickSubscriber;
use Symfony\Component\Form\AbstractType;
use App\Repository\TrickGroupRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TrickEditType extends AbstractType
{
//    private $subscriber;
//
//    public function __construct(EditTrickSubscriber $subscriber)
//    {
//        $this->subscriber = $subscriber;
//    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class, array(
                'attr' => array('class' => 'tinymce'),
            ))
            ->add('trickGroup', EntityType::class, array(
                'class' => 'App\Entity\TrickGroup',
                'required' => false,
                'placeholder' => 'Choose a type of trick',
                'query_builder' => function(TrickGroupRepository $trickGroupRepository) {
                    return $trickGroupRepository->getTrickGroupsAlphabetically();
                }))
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'entry_options' => [
                    'label' => false
                ],


            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'entry_options' => [
                    'label' => false
                ],
            ])
        ;

//        $builder->get('images')->addEventSubscriber($this->subscriber);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Trick::class,
        ));
    }
}