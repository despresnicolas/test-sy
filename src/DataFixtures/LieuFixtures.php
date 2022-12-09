<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LieuFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $ville = $manager->getRepository(Ville::class)->findAll();

        for ($i = 1; $i < 10; $i++) {
            $lieu = new Lieu();
            $lieu->setNom("lieu $i");
            $lieu->setRue("rue $i");
            $lieu->setVille($ville[mt_rand(0, count($ville) - 1)]);
            $manager->persist($lieu);
        }
        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [VilleFixtures::class];
    }
}
