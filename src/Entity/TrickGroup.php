<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class TrickGroup
{
    private $id;
    private $group;
    private $tricks;

    public function __construct()
    {
        $this->tricks = new ArrayCollection();
    }

    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function getTricks(): ArrayCollection
    {
        return $this->tricks;
    }

    // Used to generate the select field on the trick forms
    public function __toString()
    {
        return $this->getGroup();
    }


}