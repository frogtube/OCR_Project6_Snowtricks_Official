<?php

namespace App\Entity;


class Image
{
    private $id;
    private $filename;
    private $caption;
    private $trick;
    private $user;

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFilename(string $filename): void
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

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function getTrick(): ?int
    {
        return $this->trick;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

}