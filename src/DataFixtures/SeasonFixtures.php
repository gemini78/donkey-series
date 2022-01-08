<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        [
            "number" => 1,
            "year" => 2015,
            "description" => "season 1"
        ],
        [
            "number" => 2,
            "year" => 2016,
            "description" => "season 2"
        ],
        [
            "number" => 3,
            "year" => 2017,
            "description" => "season 3"
        ],
        [
            "number" => 1,
            "year" => 2015,
            "description" => "season 1"
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $key => $datas) {
            $season = new Season();
            $season
                ->setNumber($datas['number'])
                ->setYear($datas['year'])
                ->setDescription($datas['description'])
                ->setProgram($this->getReference('program_0'));

            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
