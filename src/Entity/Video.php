<?php

namespace App\Entity;

class Video
{
    private $id;
    private $embed;
    private $trick;

    // SETTERS
    public function __toString()
    {
        return $this->embed;
    }

    public function setEmbed(string $url): void
    {
        $embed = str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $url);
        $this->embed = $embed;
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

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

}