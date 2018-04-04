<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use App\Subscriber\ProfileImageSubscriber;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImageType extends AbstractType
{
    private $profileImageSubscriber;

    public function __construct(ProfileImageSubscriber $subscriber)
    {
        $this->profileImageSubscriber = $subscriber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', FileType::class, [
                'image_property' => 'filename',
                'label' => false,
            ]) // Getting an UploadedFile
            ->addEventSubscriber($this->profileImageSubscriber); // Converting into Image entity
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Image::class,
        ));
    }
}