<?php

namespace Entity;


class User
{
    private $id;
    private $username;
    private $email;
    private $firstname;
    private $lastname;
    private $password;
    private $avatar;
    private $role;
    private $active;
    private $createdAt;

    // GETTERS
    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getFirstname() { return $this->firstname; }
    public function getLastname() { return $this->lastname; }
    public function getPassword() { return $this->password; }
    public function getAvatar() { return $this->avatar; }
    public function getRole() { return $this->role; }
    public function getActive() { return $this->active; }
    public function getCreatedAt() { return $this->createdAt; }

    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

}