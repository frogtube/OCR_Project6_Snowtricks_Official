<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 200; $i++) {

            $comment = new Comment();
            $comment->setContent('Voici le commentaire ' . $i);

            $date = new \DateTime('now');
            date_sub($date, date_interval_create_from_date_string(mt_rand(1, 30).'days'));
            $comment->setCreatedAt($date);

            $comment->setUser($this->getReference('user-fixture '.mt_rand(0,3)));
            $comment->setTrick($this->getReference('trick-fixture '.mt_rand(0,9)));

            $manager->persist($comment);
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