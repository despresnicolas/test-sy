<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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

        if ($this->getUser()->getUserIdentifier() === $participant->getMail()) {
            return $this->redirectToRoute('participant_edit', ['id' => $id]);
        }
        return $this->render('participant/profile.html.twig', [
            'participant' => $participant
        ]);
    }

    /**
     * @Route("/participant/{id}/edit", name="participant_edit")
     */
    public function edit(int $id, ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);

        if ($this->getUser()->getUserIdentifier() !== $participant->getMail()) {
            return $this->redirectToRoute('participant_profil', ['id' => $id]);
        }

        $participantForm = $this->createForm(ParticipantType::class, $participant);

        return $this->render('participant/edit.html.twig', [
            'participantForm' => $participantForm->createView()
        ]);
    }


}
