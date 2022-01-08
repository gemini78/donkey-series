<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    const ACTORS  = [
        "Andrew Lincoln",
        "Norman Reedus",
        "Lauren Cohan",
        "Danai Gurira",
        "Jon Bernthal",
        "Emilia Clarke",
        "Kit Harington",
        "Victoria Pedretti"
    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
        }
        $manager->flush();
    }
}
