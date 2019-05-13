<?php

namespace App\Tests\Entity;

use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    public function testConstructor()
    {

    }

    public function testSettingName()
    {
        $trick = new Trick();
        $this->assertNull($trick->getName());

        $trick->setName('backflip');
        $this->assertSame('backflip', $trick->getName());
    }

    public function testSettingSlug()
    {
        $trick = new Trick();
        $trick->setSlug('backflip');
        $this->assertSame('backflip', $trick->getSlug());
    }

    public function testSettingDescription()
    {
        $trick = new Trick();
        $this->assertNull($trick->getDescription());

        $trick->setDescription('360 degres backwards');
        $this->assertSame('360 degres backwards', $trick->getDescription());
    }

    public function testSettingGroup()
    {
        $trickGroup = new TrickGroup();
        $trick = new Trick();
        $trick->setTrickGroup($trickGroup);
        $this->assertSame($trickGroup, $trick->getTrickGroup());
    }

    public function testSettingCreatedAt()
    {
        $date = new \DateTime('2017-12-27 14:43:12');
        $trick = new Trick();
        $trick->setCreatedAt($date);
        $this->assertSame($date, $trick->getCreatedAt());
    }

    public function testSettingUser()
    {
        $user = new User();
        $trick = new Trick();
        $trick->setUser($user);
        $this->assertSame($user, $trick->getUser());
    }

    public function testCreatingTrick()
    {
        $user = new User();
        $name= 'backflip 180';
        $trick = new Trick();
        $trick->createTrick($name, $user);

        $this->assertSame('Backflip 180', $trick->getName());
        $this->assertSame('backflip-180', $trick->getSlug());
        $this->assertSame($user, $trick->getUser());
    }

}