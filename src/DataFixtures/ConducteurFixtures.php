<?php

namespace App\DataFixtures;

use App\Entity\Conducteur;
use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ConducteurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 5; $i++){
            $conducteur = new Conducteur();
            $conducteur -> setPrenom($faker->firstName())
                    -> setNom($faker -> lastName());
            $manager->persist($conducteur);
            for($j = 0; $j < 2 ; $j++){
                $vehicule = new Vehicule();
                $vehicule -> setMarque($faker->sentence(2,true))
                          -> setCouleur($faker -> safeColorName())
                          -> setImmatriculation($faker->regexify('[A-Z]{2}-[0-9]{3}-[A-Z]{2}'))
                          -> setModele($faker -> sentence(1,true))
                          -> addConducteur($conducteur);
                $manager->persist($vehicule);
            }
        }
        $manager->flush();
    }
}
