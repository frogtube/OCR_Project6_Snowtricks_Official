<?php

namespace App\Entity;


class Video
{
    private $id;
    private $embed;
    private $caption;

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

}