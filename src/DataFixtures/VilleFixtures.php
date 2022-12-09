<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture
{
    /**
     * @var \string[][]
     */
    private array $listVilles = [
        ['nantes', "44000"],
        ['niort', "79000"],
        ['quimper', "29000"],
        ['rennes', "35000"]
    ];

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->listVilles as $arrValue) {
            $ville = new Ville();
            $ville->setNom("$arrValue[0]");
            $ville->setCodePostal("$arrValue[1]");
            $manager->persist($ville);
        }
        $manager->flush();
    }
}
