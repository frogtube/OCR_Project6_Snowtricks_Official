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
            $video->setEmbed('Video ' . $i);
            $video->setCaption('Ceci est la description de la video '.$i);
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