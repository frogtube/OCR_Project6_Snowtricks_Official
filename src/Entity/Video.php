<?php

namespace Entity;


class Video
{
    private $id;
    private $embed;
    private $caption;

    // GETTERS
    public function getId() { return $this->id; }
    public function getEmbed() { return $this->embed; }
    public function getCaption() { return $this->caption; }

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
}