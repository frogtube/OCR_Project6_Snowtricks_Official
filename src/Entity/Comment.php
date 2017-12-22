<?php

namespace Entity;


class Comment
{
    private $id;
    private $content;
    private $createdAt;

    // GETTERS
    public function getId() { return $this->id; }
    public function getContent() { return $this->content; }
    public function getCreatedAt() { return $this->createdAt; }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}