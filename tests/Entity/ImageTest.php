<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testSettingName()
    {
        $trick = new Image();
        $this->assertSame(null, $trick->getFilename());

        $trick->setFilename('backflip.jpg');
        $this->assertSame('backflip.jpg', $trick->getFilename());
    }

    public function testSettingCaption()
    {
        $trick = new Image();
        $this->assertSame(null, $trick->getCaption());

        $trick->setCaption('A guy doing a backflip in snowboard');
        $this->assertSame('A guy doing a backflip in snowboard', $trick->getCaption());
    }

    public function testSettingTrick()
    {
        $trick = new Image();
        $this->assertSame(null, $trick->getTrick());

        $trick->setTrick(6);
        $this->assertSame(6, $trick->getTrick());
    }

    public function testSettingUser()
    {
        $trick = new Image();
        $this->assertSame(null, $trick->getUser());

        $trick->setUser(4);
        $this->assertSame(4, $trick->getUser());
    }


}