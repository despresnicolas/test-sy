<?php

namespace App\Controller;

use App\Form\ParticipantType;
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
        $participant = $participantRepository->find($id);

        if ($this->getUser() === $participant) {
            $participantForm = $this->createForm(ParticipantType::class, $participant);
            return $this->render('participant/edit.html.twig', [
                'participantForm' => $participantForm->createView()
            ]);
        }
        return $this->render('participant/profile.html.twig', [
            'participant' => $participant
        ]);
    }

}
