<?php

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ImageTypeExtension extends AbstractTypeExtension
{

    public function getExtendedType()
    {
        return FileType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // Makes it legal for FileType fields to have an image_property option
       $resolver->setDefined([
          'image_property'
       ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        if (isset($options['image_property'])) {
            $parentData = $form->getParent()->getData();

            $imageUrl = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $file = $accessor->getValue($parentData, $options['image_property']);
                $imageUrl = '/uploads/images/' . $file->getFilename();
            }

            // Sets an 'image_url' variable that will be available when rendering this field
            $view->vars['image_url'] = $imageUrl;

        }
    }

}