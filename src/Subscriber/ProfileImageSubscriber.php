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
            FormEvents::SUBMIT => 'onSubmit'
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function onSubmit(FormEvent $event): void
    {
        die();
        if (!$event->getData()) {
            return;
        }

        $filename = $this->fileUploader->upload($event->getData()); // Name of the local image
        dump($filename); die();

        $image = new Image();
        $image->setFilename($filename); // Image entity created
        $image->setUser($this->tokenStorage->getToken()->getUser()); // Image entity with User relationship

        $event->getForm()->setData($image);
    }

}