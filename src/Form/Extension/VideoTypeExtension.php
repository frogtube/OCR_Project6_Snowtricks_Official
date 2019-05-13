<?php

namespace App\Form\Extension;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VideoTypeExtension extends AbstractTypeExtension
{

    public function getExtendedType()
    {
        return TextType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // Makes it legal for TextType fields to have a video_property option
       $resolver->setDefined([
          'video_property'
       ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        if (isset($options['video_property'])) {

            $parentData = $form->getParent()->getData();

            $videoUrl = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $video = $accessor->getValue($parentData, $options['video_property']);
                $videoUrl = $video;
            }

            // Sets a 'video_url' variable that will be available when rendering this field
            $view->vars['video_url'] = $videoUrl;
        }
    }

}