<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testSettingName()
    {
        $image = new Image();
        $this->assertSame(null, $image->getFilename());

        $image->setFilename('backflip.jpg');
        $this->assertSame('backflip.jpg', $image->getFilename());
    }

    public function testSettingCaption()
    {
        $image = new Image();
        $this->assertSame(null, $image->getCaption());

        $image->setCaption('A guy doing a backflip in snowboard');
        $this->assertSame('A guy doing a backflip in snowboard', $image->getCaption());
    }

    public function testSettingTrick()
    {
        $trick = new Trick();
        $image = new Image();
        $image->setTrick($trick);
        $this->assertSame($trick, $image->getTrick());
    }

    public function testSettingUser()
    {
        $user = new User();
        $image = new Image();
        $image->setUser($user);
        $this->assertSame($user, $image->getUser());
    }

}