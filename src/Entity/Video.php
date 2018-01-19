<?php

namespace App\Entity;


class Video
{
    private $id;
    private $embed;
    private $caption;
    private $trick;

    // SETTERS

    public function setEmbed(string $embed): void
    {
        $this->embed = $embed;
    }

    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    public function setTrick(Trick $trick): void
    {
        $this->trick = $trick;
    }

    // GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmbed(): ?string
    {
        return $this->embed;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

}