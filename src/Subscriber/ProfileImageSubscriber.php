<?php

namespace App\Subscriber;

use App\Entity\Image;
use App\Service\FileUploader;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProfileImageSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;
    private $fileUploader;

    /**
     * ProfileImageSubscriber constructor.
     * @param FileUploader $fileUploader
     * @param TokenStorageInterface $token
     */
    public function __construct(FileUploader $fileUploader, TokenStorageInterface $token)
    {
        $this->fileUploader = $fileUploader;
        $this->tokenStorage = $token;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'onSubmit'
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function onSubmit(FormEvent $event): void
    {
        if (!$event->getData()) {
            return;
        }

        foreach ($event->getData() as $uploadedFile) {

            $filename = $this->fileUploader->upload($uploadedFile); // Name of the local image
            $image = new Image();
            $image->setFilename($filename); // Image entity created
            $event->getForm()->getParent()->getData()->add($image);
        }
    }

}