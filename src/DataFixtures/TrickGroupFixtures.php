<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\TrickGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrickGroupFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $group = ['jump', 'grab', 'flip', 'rotation'];

        for ($i = 0; $i < 4; $i++) {

            $trickGroup = new TrickGroup();
            $trickGroup->setGroup($group[$i]);
            $this->addReference('trickGroup-fixture '.$i, $trickGroup);
            $manager->persist($trickGroup);
        }
        $manager->flush();
    }
}