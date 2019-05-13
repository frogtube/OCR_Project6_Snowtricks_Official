<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use function Sodium\add;

class UserTest extends TestCase
{
    public function testConstructor()
    {
        $user = new User();
        $this->assertSame(false, $user->isActive());
        $this->assertNull($this->testSettingResetPasswordToken());
        // tricks and comments arrayCollections
    }

    public function testSettingUsername()
    {
        $user = new User();
        $this->assertNull($user->getUsername());

        $user->setUsername('arnold34');
        $this->assertSame('arnold34', $user->getUsername());
    }

    public function testSettingEmail()
    {
        $user = new User();
        $this->assertNull($user->getEmail());

        $user->setEmail('arnold34@gmail.com');
        $this->assertSame('arnold34@gmail.com', $user->getEmail());
    }

    public function testSettingFirstname()
    {
        $user = new User();
        $this->assertNull($user->getFirstname());

        $user->setFirstname('arnold');
        $this->assertSame('arnold', $user->getFirstname());
    }

    public function testSettingLastname()
    {
        $user = new User();
        $this->assertNull($user->getLastname());

        $user->setLastname('willy');
        $this->assertSame('willy', $user->getLastname());
    }

    public function testSettingPassword()
    {
        $user = new User();
        $this->assertNull($user->getPassword());

        $user->setPassword('Ilovedogs');
        $this->assertSame('Ilovedogs', $user->getPassword());
    }

    public function testSettingRole()
    {
        $user = new User();
        $this->assertSame([], $user->getRoles());

        $user->setRoles(['user']);
        $this->assertSame(['user'], $user->getRoles());
    }

    public function testSettingActive()
    {
        $user = new User();
        $this->assertSame(false, $user->isActive());

        $user->setIsActive(true);
        $this->assertSame(true, $user->isActive());
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

    public function testSettingResetPasswordToken()
    {
        $user = new User();
        $user->setResetPasswordToken(null);
        $this->assertNull($user->getResetPasswordToken());

        $user->setResetPasswordToken('zdh43rkt435fjds54nlkn45v3');
        $this->assertSame('zdh43rkt435fjds54nlkn45v3', $user->getResetPasswordToken());
    }

    public function testSettingResetPasswordTokenTimestamp()
    {
        $user = new User();
        $user->setResetPasswordTokenTimestamp(null);
        $this->assertNull($user->getResetPasswordTokenTimestamp());

        $date = new \DateTime('2017-12-27 14:43:12');
        $user->setResetPasswordTokenTimestamp($date);
        $this->assertSame($date, $user->getResetPasswordTokenTimestamp());
    }

    public function testSettingActivationToken()
    {
        $user = new User;
        $user->setActivationToken(null);
        $this->assertNull($user->getActivationToken());

        $user->setActivationToken('zdh43rkt435fjds54nlkn45v3');
        $this->assertSame('zdh43rkt435fjds54nlkn45v3', $user->getActivationToken());

    }

}