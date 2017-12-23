<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Trick
{
    private $id;
    private $name;
    private $description;
    private $group;
    private $createdAt;
    private $user;
    private $comments;
    private $videos;
    private $images;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function getVideos()
    {
        return $this->videos;
    }

    public function getImages()
    {
        return $this->images;
    }
}