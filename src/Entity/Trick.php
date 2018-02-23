<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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

    public function setImages($image): void
    {
        if ($this->getImages()->contains($image)) {
            return;
        }
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

    /**
     * @return  ArrayCollection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @return ArrayCollection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    /**
     * @return ArrayCollection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function createTrick($trickName, User $user)
    {
        $this->setName(ucfirst($trickName));
        $this->setSlug(strtolower(str_replace(' ', '-', $trickName)));
        $this->setCreatedAt(new \DateTime());
        $this->setUser($user);
    }

    public function addImage(Image $image)
    {
        $this->images->add($image);
    }

    public function removeImage(Image $image)
    {
        $this->images->remove($image);
    }
}