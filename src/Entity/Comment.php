<?php

namespace App\Entity;


class Comment
{
    private $id;
    private $content;
    private $createdAt;
    private $trick;
    private $user;

   // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
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