<?php

namespace App\Entity;

class Trick
{
    private $id;
    private $name;
    private $description;
    private $group;
    private $createdAt;
    private $user;

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

}