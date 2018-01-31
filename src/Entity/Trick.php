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
    private $createdAt;
    private $trickGroup;
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

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setTrickGroup(TrickGroup $trickGroup): void
    {
        $this->trickGroup = $trickGroup;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function setImages(Image $image): void
    {
        $this->images[] = $image;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getTrickGroup(): ?TrickGroup
    {
        return $this->trickGroup;
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