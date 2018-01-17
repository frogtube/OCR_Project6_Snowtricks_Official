<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use function Sodium\add;

class UserTest extends TestCase
{
    public function testSettingUsername()
    {
        $user = new User();
        $this->assertSame(null, $user->getUsername());

        $user->setUsername('arnold34');
        $this->assertSame('arnold34', $user->getUsername());
    }

    public function testSettingEmail()
    {
        $user = new User();
        $this->assertSame(null, $user->getEmail());

        $user->setEmail('arnold34@gmail.com');
        $this->assertSame('arnold34@gmail.com', $user->getEmail());
    }

    public function testSettingFirstname()
    {
        $user = new User();
        $this->assertSame(null, $user->getFirstname());

        $user->setFirstname('arnold');
        $this->assertSame('arnold', $user->getFirstname());
    }

    public function testSettingLastname()
    {
        $user = new User();
        $this->assertSame(null, $user->getLastname());

        $user->setLastname('willy');
        $this->assertSame('willy', $user->getLastname());
    }

    public function testSettingPassword()
    {
        $user = new User();
        $this->assertSame(null, $user->getPassword());

        $user->setPassword('Ilovedogs');
        $this->assertSame('Ilovedogs', $user->getPassword());
    }

    public function testSettingAvatar()
    {
        $user = new User();
        $this->assertSame(null, $user->getAvatar());

        $user->setAvatar('puppy.jpg');
        $this->assertSame('puppy.jpg', $user->getAvatar());
    }

    public function testSettingRole()
    {
        $user = new User();
        $this->assertSame(null, $user->getRole());

        $user->setRole('admin');
        $this->assertSame('admin', $user->getRole());
    }

    public function testSettingActive()
    {
        $user = new User();
        $this->assertSame(null, $user->getActive());

        $user->setActive(true);
        $this->assertSame(true, $user->getActive());
    }

    public function testSettingCreatedAt()
    {
        $date = new \DateTime('2017-12-27 14:43:12');
        $user = new User();
        $user->setCreatedAt($date);
        $this->assertSame($date, $user->getCreatedAt());
    }

    public function testSettingImage()
    {
        $image = new Image();
        $user = new User();
        $user->setImage($image);
        $this->assertSame($image, $user->getImage());
    }

}