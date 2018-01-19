<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Trick
{
    private $id;
    private $name;
    private $slug;
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }
}