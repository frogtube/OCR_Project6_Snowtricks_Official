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
    private $filename;

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
            FormEvents::PRE_SUBMIT => 'preSubmit',
            FormEvents::SUBMIT => 'onSubmit',
            FormEvents::POST_SET_DATA => 'postSetData',
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event): void
    {

        if (!$event->getData()['filename']) {
            return;
        }

        foreach ($event->getData() as $uploadedFile) {
            $filename = $this->fileUploader->upload($uploadedFile); // Name of the local image
            $this->filename = $filename;
        }

    }

    /**
     * @param FormEvent $event
     */
    public function onSubmit(FormEvent $event): void
    {

        if (!$event->getData()) {
            return;
        }

        $event->getData()->setFilename($this->filename);


    }

    /**
     * @param FormEvent $event
     */
    public function postSetData(FormEvent $event): void
    {
//        if (!$event->getData() || !$event->getData()->getFilename()) {
//            return;
//        }
//
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//
//            $image = $event->getData();
//            $imageName = $image->getFilename()->getFilename();
//
//            $image->setFilename($imageName);
//        }
    }








}