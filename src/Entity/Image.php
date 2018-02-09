<?php

namespace App\Entity;


use Symfony\Component\HttpFoundation\File\File;

class Image
{
    private $id;
    private $filename;
    private $caption;
    private $trick;
    private $user;

    // SETTERS

    public function setFilename($filename): void
    {
        $this->filename = $filename;
    }

    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    public function setTrick(Trick $trick): void
    {
        $this->trick = $trick;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    // GETTERS
    public function getId(): int
    {
        return $this->id;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

}