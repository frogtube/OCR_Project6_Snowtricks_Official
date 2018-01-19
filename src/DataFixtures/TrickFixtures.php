<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $group = ['jump', 'grab', 'rotation', 'flip'];

        for ($i = 0; $i < 10; $i++) {

            $trick = new Trick();
            $trick->setName('Trick ' . $i);
            $trick->setSlug('Trick-' . $i);
            $trick->setCreatedAt(new \DateTime('now'));
            $trick->setUser($this->getReference('user-fixture '.mt_rand(0,3)));
            $trick->setGroup($group[mt_rand(0,3)]);
            $trick->setDescription('Ceci est la description du trick '.$i);
            $this->addReference('trick-fixture '.$i, $trick);
            $manager->persist($trick);

        }
        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }

}