<?php

namespace App\Tests\Entity;

use App\Entity\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function testSettingContent()
    {
        $trick = new Comment();
        $this->assertSame(null, $trick->getContent());

        $trick->setContent('so great!');
        $this->assertSame('so great!', $trick->getContent());
    }

    public function testSettingCreatedAt()
    {
        $trick = new Comment();
        $this->assertSame(null, $trick->getCreatedAt());

        $trick->setCreatedAt('2017-12-27 14:43:12');
        $this->assertSame('2017-12-27 14:43:12', $trick->getCreatedAt());
    }

    public function testSettingUser()
    {
        $trick = new Comment();
        $this->assertSame(null, $trick->getUser());

        $trick->setUser(6);
        $this->assertSame(6, $trick->getUser());
    }

    public function testSettingTrick()
    {
        $trick = new Comment();
        $this->assertSame(null, $trick->getTrick());

        $trick->setTrick(8);
        $this->assertSame(8, $trick->getTrick());
    }

}