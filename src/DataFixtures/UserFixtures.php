<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++) {
            $user = new User();
            $user->setUsername('user');
            $user->setEmail('user@gmail.com');
            $user->setFirstname('firstname');
            $user->setLastname('lastname');
            $user->setPassword('password');
            $user->setAvatar('avatar');
            $user->setRole('admin');
            $user->setActive(true);
            $user->setCreatedAt(new \DateTime('now'));
            $this->addReference('user-fixture '.$i, $user);
            $manager->persist($user);
        }
        $manager->flush();

    }
}