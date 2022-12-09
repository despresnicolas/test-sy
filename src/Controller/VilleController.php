<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    /**
     * @param VilleRepository $villeRepository
     * @param ParticipantRepository $participantRepository
     * @return Response
     * @Route("/villes", name="villes_main")
     */
    public function main(
        VilleRepository       $villeRepository,
        ParticipantRepository $participantRepository
    ): Response
    {
        $villes = $villeRepository->findAll();
        $user = $participantRepository->find($this->getUser());

        if ($user->isAdministrateur()) {
            return $this->render('villes/main.html.twig', [
                'villes' => $villes,
            ]);
        }

        return $this->redirectToRoute('main_home');

    }
}
