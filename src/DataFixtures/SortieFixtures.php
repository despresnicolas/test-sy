<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Participant;
use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SortieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $etat = $manager->getRepository(Etat::class)->findAll();
        $lieu = $manager->getRepository(Lieu::class)->findAll();
        $participant = $manager->getRepository(Participant::class)->findAll();

        for($i=1; $i < 10; $i++) {
            $sortie = new Sortie();
            $sortie->setNom("sortie $i");
            $sortie->setDateHeureDebut(new \DateTime());
            $sortie->setDuree(mt_rand(30, 240));
            $d = clone $sortie->getDateHeureDebut();
            $sortie->setDateLimiteInscription(date_add($d, date_interval_create_from_date_string("-10 days")));
            $sortie->setNbInscriptionsMax(mt_rand(3,50));
            $sortie->setEtat($etat[mt_rand(0, count($etat) -1)]);
            $sortie->setLieu($lieu[mt_rand(0, count($lieu) -1)]);
            $sortie->setOrganisateur($participant[mt_rand(0, count($participant) -1)]);
            $sortie->setSiteOrganisateur($sortie->getOrganisateur()->getCampus());


            $manager->persist($sortie);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [EtatFixtures::class, LieuFixtures::class,ParticipantFixtures::class];
    }
}
