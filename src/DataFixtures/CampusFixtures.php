<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampusFixtures extends Fixture
{
    private $campusList = ['nantes', 'niort', 'quimper', 'rennes'];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->campusList as $name) {
            $campus = new Campus();
            $campus->setNom($name);
            $manager->persist($campus);
        }

        $manager->flush();
    }
}
