<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 8; $i++) {

            $video = new Video();
            $video->setEmbed('Vhttps://www.youtube.com/watch?v=X9DIG3Ux79E');
            $video->setTrick($this->getReference('trick-fixture '.mt_rand(0,9)));

            $manager->persist($video);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TrickFixtures::class,
        );
    }

}