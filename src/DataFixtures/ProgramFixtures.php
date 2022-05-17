<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Node\Stmt\Break_;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS  = [
        [
            "title" => "The Walking Dead",
            "synopsis" => "L'histoire suit le personnage de Rick Grimes (interprété par Andrew Lincoln), adjoint du shérif du comté de Kings (en Géorgie). Il se réveille d'un coma de plusieurs semaines pour découvrir que la population a été ravagée par une épidémie inconnue qui transforme les êtres humains en morts-vivants, appelés « rôdeurs ».",
            "poster" => "https://images-na.ssl-images-amazon.com/images/I/81zqK4i3H0S.jpg",
            "country" => "USA",
            "year" => 2010,
            "index_category" => 4
        ],

        [
            "title" => "The Big Bang Theory",
            "synopsis" => "Leonard Hofstadter et Sheldon Cooper vivent en colocation à Pasadena, ville de l'agglomération de Los Angeles. Ce sont tous deux des physiciens surdoués, « geeks » de surcroît. C'est d'ailleurs autour de cela qu'est axée la majeure partie comique de la série. Ils partagent quasiment tout leur temps libre avec leurs deux amis Howard Wolowitz et Rajesh Koothrappali pour jouer à des jeux vidéo comme Halo, organiser un marathon de la saga Star Wars, jouer à des jeux de société comme le Boggle klingon ou de rôles tel que Donjons et Dragons, voire discuter de théories scientifiques très complexes.Leur univers routinier est perturbé lorsqu'une jeune femme, Penny, s'installe dans l'appartement d'en face. Leonard a immédiatement des vues sur elle et va tout faire pour la séduire ainsi que l'intégrer au groupe et à son univers, auquel elle ne connaît rien.",
            "poster" => "https://upload.wikimedia.org/wikipedia/fr/6/69/BigBangTheory_Logo.png",
            "country" => "États-Unis",
            "year" => 2007,
            "index_category" => 5
        ],
        [
            "title" => "Game of Thrones",
            "synopsis" => "Set on the fictional continents of Westeros and Essos, Game of Thrones has a large ensemble cast and follows several story arcs throughout the course of the show. The first major arc concerns the Iron Throne of the Seven Kingdoms of Westeros through a web of political conflicts among the noble families either vying to claim the throne or fighting for independence from whoever sits on it. A second focuses on the last descendant of the realm's deposed ruling dynasty, who has been exiled to Essos and is plotting to return and reclaim the throne. The third follows the Night's Watch, a military order defending the realm against threats from beyond Westeros's northern border.",
            "poster" => "https://m.media-amazon.com/images/I/91DjGXn7jXL._AC_SL1500_.jpg",
            "country" => "États-Unis",
            "year" => 2011,
            "index_category" => 4
        ],
        [
            "title" => "Fear The Walking Dead",
            "synopsis" => "L'histoire se déroule au tout début de l'épidémie relatée dans la série mère The Walking Dead et se passe dans la ville de Los Angeles Madison est conseillère d'orientation dans un lycée de Los Angeles. Depuis la mort de son mari, elle élève seule ses deux enfants : Alicia, excellente élève qui découvre les premiers émois amoureux, et son grand frère Nick qui a quitté la fac et a sombré dans la drogue.",
            "poster" => "https://www.ecranlarge.com/uploads/image/001/395/upmd11a2zazeg1j6wrgdd4b5cxs-637.jpg",
            "country" => "États-Unis",
            "year" => 2015,
            "index_category" => 4
        ],
        [
            "title" => "The Haunting Of Hill House",
            "synopsis" => "Plusieurs frères et sœurs qui, enfants, ont grandi dans la demeure qui allait devenir la maison hantée la plus célèbre des États-Unis sont contraints de se retrouver pour faire face à cette tragédie ensemble.",
            "poster" => "https://static.fnac-static.com/multimedia/Images/FR/NR/de/ce/ac/11325150/1540-1/tsp20190806141213/The-Haunting-Of-Hill-House-Score-Edition-Limitee.jpg",
            "country" => "États-Unis",
            "year" => 2018,
            "index_category" => 4
        ]
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::PROGRAMS as $key => $datas) {
            $program = new Program();
            $program
                ->setTitle($datas['title'])
                ->setSynopsis($datas['synopsis'])
                ->setPoster($datas['poster'])
                ->setYear($datas['year'])
                ->setCountry($datas['country'])
                ->setCategory($this->getReference('category_' . $datas['index_category']));

            switch ($key) {
                case 0: // The Walking Dead'
                    for ($i = 0; $i < 5; $i++) {
                        $program->addActor($this->getReference('actor_' . $i));
                    }
                    break;
                case 2:  // Game of Thrones
                    $program->addActor($this->getReference('actor_5'));
                    $program->addActor($this->getReference('actor_6'));
                    break;
                case 3: // Fear The Walking Dead.
                    $program->addActor($this->getReference('actor_0'));
                    break;
                case 4: //The Haunting Of Hill House
                    $program->addActor($this->getReference('actor_7'));
                    break;
                default:
                    # code...
                    break;
            }

            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ActorFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
