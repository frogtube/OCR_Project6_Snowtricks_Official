<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use function Sodium\add;

class UserTest extends TestCase
{
    public function testSettingUsername()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getUsername());

        $trick->setUsername('arnold34');
        $this->assertSame('arnold34', $trick->getUsername());
    }

    public function testSettingEmail()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getEmail());

        $trick->setEmail('arnold34@gmail.com');
        $this->assertSame('arnold34@gmail.com', $trick->getEmail());
    }

    public function testSettingFirstname()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getFirstname());

        $trick->setFirstname('arnold');
        $this->assertSame('arnold', $trick->getFirstname());
    }

    public function testSettingLastname()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getLastname());

        $trick->setLastname('willy');
        $this->assertSame('willy', $trick->getLastname());
    }

    public function testSettingPassword()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getPassword());

        $trick->setPassword('Ilovedogs');
        $this->assertSame('Ilovedogs', $trick->getPassword());
    }

    public function testSettingAvatar()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getAvatar());

        $trick->setAvatar('puppy.jpg');
        $this->assertSame('puppy.jpg', $trick->getAvatar());
    }

    public function testSettingRole()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getRole());

        $trick->setRole('admin');
        $this->assertSame('admin', $trick->getRole());
    }

    public function testSettingActive()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getActive());

        $trick->setActive(true);
        $this->assertSame(true, $trick->getActive());
    }

    public function testSettingCreatedAt()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getCreatedAt());

        $trick->setCreatedAt('2017-12-27 14:43:12');
        $this->assertSame('2017-12-27 14:43:12', $trick->getCreatedAt());
    }

    public function testSettingImage()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getImage());

        $trick->setImage(4);
        $this->assertSame(4, $trick->getImage());
    }

    public function testGettingTricks()
    {
        $trick = new User();
        $trick->getTricks()
        $this->assertSame(null, $trick->getTricks());

        // Is mocking required here ?
    }

    public function testGettingComments()
    {
        $trick = new User();
        $this->assertSame(null, $trick->getComments());

        // Is mocking required here ?
    }


}