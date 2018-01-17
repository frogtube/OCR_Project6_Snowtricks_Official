<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

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
    private $image;
    private $tricks;
    private $comments;

    public function __construct()
    {
        $this->tricks = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    // SETTERS
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

    // GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function getTricks(): ?ArrayCollection
    {
        return $this->tricks;
    }

    public function getComments(): ?ArrayCollection
    {
        return $this->comments;
    }



}