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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setTrick(Trick $trick): void
    {
        $this->trick = $trick;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    // GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

}