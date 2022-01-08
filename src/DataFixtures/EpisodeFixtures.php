<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        [
            "title" => "Passé décomposé",
            "synopsis" => "Dans le Kentucky, Rick Grimes, un policier, se réveille à l'hôpital après plusieurs semaines de coma provoqué par une fusillade qui a mal tourné. Il découvre que le monde, ravagé par une épidémie, est envahi par les morts-vivants. Rick ne songe qu'à une chose : retrouver sa femme Lori et son fils Carl.",
            "number" => 1,
            "index_season" => 0
        ],
        [
            "title" => "Tripes",
            "synopsis" => "Rick parvient à s'extraire du char et rencontre un groupe de survivants avec le jeune Glenn, Andrea, Morales, T-Dog et Merle Dixon, un homme passablement raciste et énervé. Tous sont réfugiés dans un immeuble et se demandent comment en sortir. Les zombies tentent de prendre d'assaut le bâtiment.",
            "number" => 2,
            "index_season" => 0
        ],
        [
            "title" => "T'as qu'à discuter avec les grenouilles",
            "synopsis" => "Après son retour au camp avec les rescapés du magasin et une rencontre émouvante avec sa femme et son fils, Rick décide d'aller contre l'avis de Shane et retourner à Atlanta pour Merle Dixon et son sac d'armes abandonné, accompagné par le frère cadet de Merle, Darryl Dixon, ainsi que Glenn et T-Dog...",
            "number" => 3,
            "index_season" => 0
        ],
        [
            "title" => "Le gang",
            "synopsis" => "À Atlanta, les membres du groupe découvrent que Merle a réussi à s'enfuir. Ils tentent ensuite de récupérer les armes mais tombent sur d'autres survivants qui convoitent eux aussi les munitions. Glenn est capturé par la bande de Guillermo, qui menace de le tuer si le groupe ne lui donne pas les armes. Les hommes débattent : Rick doit sa vie à Glenn, il ne veut pas l'abandonner.",
            "number" => 4,
            "index_season" => 0
        ],
        [
            "title" => "Wildfire",
            "synopsis" => "L’attaque surprise du camp par une horde de zombies a été particulièrement meurtrière. La pauvre Amy connaît un destin tragique. elle n’est pas la seule, Jim a été mordu pendant l’attaque et est isolé par les autres dans un camping-car en attendant « sa transformation » et pour sa sécurité… Les tensions se font jour à nouveau entre les survivants, notamment entre Daryl Nixon et les autres ; Daryl étant plutôt porté à trouver une solution rapide et sanglante au problème de Jim, en lui défonçant le crâne à coup de pioche !",
            "number" => 5,
            "index_season" => 0
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $datas) {
            $episode = new Episode();
            $episode
                ->setNumber($datas['number'])
                ->setTitle($datas['title'])
                ->setSynopsis($datas['synopsis'])
                ->setSeason($this->getReference('season_' . $datas['index_season']));

            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
