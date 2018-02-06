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
            $user->setUsername('user '.$i);
            $user->setEmail('user'.$i.'@gmail.com');
            $user->setFirstname('firstname'.$i);
            $user->setLastname('lastname'.$i);
            $user->setPassword('password'.$i);
            $user->setAvatar('avatar');
            $user->setRoles(array('ROLE_USER'));
            $user->setActive(true);
            $user->setCreatedAt(new \DateTime('now'));
            $this->addReference('user-fixture '.$i, $user);
            $manager->persist($user);
        }
        $manager->flush();

    }
}