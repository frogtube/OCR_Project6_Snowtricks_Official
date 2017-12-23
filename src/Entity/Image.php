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

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    public function setTrick($trick)
    {
        $this->trick = $trick;
    }

    public function setUser($user)
    {
        $this->user = $user;
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

    public function getTrick()
    {
        return $this->trick;
    }

    public function getUser()
    {
        return $this->user;
    }

}