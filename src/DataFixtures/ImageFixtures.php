<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 8; $i++) {

            $image = new Image();
            $image->setFilename('Image ' . $i);
            $image->setCaption('Ceci est la description de l\'image '.$i);
            $image->setUser(null);
            $image->setTrick($this->getReference('trick-fixture '.mt_rand(0,9)));

            $manager->persist($image);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            TrickFixtures::class,
        );
    }

}