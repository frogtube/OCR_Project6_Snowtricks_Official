<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 4; $i++) {
            $user = new User();
            $user->setUsername('user '.$i);
            $user->setEmail('user'.$i.'@gmail.com');
            $user->setFirstname('firstname'.$i);
            $user->setLastname('lastname'.$i);
            $encodedPassword = $this->encoder->encodePassword($user, 'qwertz');
            $user->setPassword($encodedPassword);
            $user->setRoles(array('ROLE_USER'));
            $user->setIsActive(true);
            $user->setCreatedAt(new \DateTime('now'));
            $this->addReference('user-fixture '.$i, $user);
            $manager->persist($user);
        }
        $manager->flush();

    }
}