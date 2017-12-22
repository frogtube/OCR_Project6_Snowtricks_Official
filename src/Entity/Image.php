<?php

namespace App\Entity;


class Image
{
    private $id;
    private $filename;
    private $caption;

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
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

    public function getFilename()
    {
        return $this->filename;
    }

    public function getCaption()
    {
        return $this->caption;
    }

}