<?php

namespace App\Controller;

use App\Repository\CampusRepository;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * @param CampusRepository $campusRepository
     * @param ParticipantRepository $participantRepository
     * @return Response
     * @Route("/campus", name="campus_main")
     */
    public function main(
        CampusRepository      $campusRepository,
        ParticipantRepository $participantRepository
    ): Response
    {
        $campus = $campusRepository->findAll();
        $user = $participantRepository->find($this->getUser());

        if ($user->isAdministrateur()) {
            return $this->render('campus/main.html.twig', [
                'campus' => $campus,
            ]);
        }

        return $this->redirectToRoute('main_home');
    }

}
