<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ParticipantFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $campus = $manager->getRepository(Campus::class)->findAll();

        for ($i = 1; $i <= 20; $i++) {
            $participant = new Participant();
            $participant->setNom("nom$i");
            $participant->setPrenom("prenom$i");
            $participant->setMail("mail$i@mail.com");
            $participant->setPseudo("pseudo$i");
            $participant->setPassword($this->userPasswordHasher->hashPassword($participant, "azerty$i"));
            $participant->setAdministrateur(0);
            $participant->setActif(1);
            $participant->setCampus($campus[mt_rand(0, count($campus) -1)]);
//            todo: inscription
//            $participant->addInscriptions();

            $manager->persist($participant);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CampusFixtures::class];

    }
}
