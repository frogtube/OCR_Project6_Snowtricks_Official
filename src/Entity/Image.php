<?php

namespace Entity;


class Image
{
    private $id;
    private $filename;
    private $caption;

    // GETTERS
    public function getId() { return $this->id; }
    public function getFilename() { return $this->filename; }
    public function getCaption() { return $this->caption; }

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
}