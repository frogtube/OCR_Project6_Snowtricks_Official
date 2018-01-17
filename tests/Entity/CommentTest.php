<?php

namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
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
        $date = new \DateTime('2017-12-27 14:43:12');
        $comment = new Comment();
        $comment->setCreatedAt($date);
        $this->assertSame($date, $comment->getCreatedAt());
    }

    public function testSettingUser()
    {
        $user = new User();
        $comment = new Comment();
        $comment->setUser($user);
        $this->assertSame($user, $comment->getUser());
    }

    public function testSettingTrick()
    {
        $trick = new Trick();
        $comment = new Comment();
        $comment->setTrick($trick);
        $this->assertSame($trick, $comment->getTrick());
    }

}