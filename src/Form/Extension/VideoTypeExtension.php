<?php

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class VideoTypeExtension extends AbstractTypeExtension
{

    public function getExtendedType()
    {
        return FileType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // Makes it legal for FileType fields to have an video_property option
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
                $videoUrl = '/uploads/images/' . $video->getEmbed();
            }

            // Sets a 'video_url' variable that will be available when rendering this field
            $view->vars['video_url'] = $videoUrl;

        }
    }

}