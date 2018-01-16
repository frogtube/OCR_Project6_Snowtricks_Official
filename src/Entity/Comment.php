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

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setTrick(int $trick): void
    {
        $this->trick = $trick;
    }

    public function setUser(int $user): void
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

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getTrick(): ?int
    {
        return $this->trick;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

}