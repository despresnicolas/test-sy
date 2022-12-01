<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participant/{id}", name="participant_profil")
     */
    public function profil(int $id, ParticipantRepository $participantRepository): Response
    {
        $particpant = $participantRepository->find($id);

        return $this->render('participant/profile.html.twig', [
            "participant" => $particpant
        ]);
    }
}
