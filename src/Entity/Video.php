<?php

namespace App\Entity;


class Video
{
    private $id;
    private $embed;
    private $caption;
    private $trick;

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmbed($embed)
    {
        $this->embed = $embed;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    public function setTrick($trick)
    {
        $this->trick = $trick;
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getEmbed()
    {
        return $this->embed;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function getTrick()
    {
        return $this->trick;
    }

}