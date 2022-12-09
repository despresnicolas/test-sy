<?php

namespace App\Controller;

use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{

    /**
     * @param int $id
     * @param ParticipantRepository $participantRepository
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route("/participant/{id}", name="participant_profil")
     */
    public function profil(
        int                         $id,
        ParticipantRepository       $participantRepository,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface      $entityManager,
        Request                     $request
    ): Response
    {
        $participant = $participantRepository->find($id);

        if (!$participant) {
//       todo:    add error message
            return $this->redirectToRoute('main_home');
        }

        if ($this->getUser() === $participant) {
            $participantForm = $this->createForm(ParticipantType::class, $participant);
            $participantForm->handleRequest($request);

            if ($participantForm->isSubmitted() && $participantForm->isValid()) {

                if ($participantForm->get('password')->getData()) {
                    $password = $participantForm->get('password')->getData();
                    $participant->setPassword($userPasswordHasher->hashPassword($participant, $password));
                }

                $entityManager->persist($participant);
                $entityManager->flush();
            }

            return $this->render('participant/edit.html.twig', [
                'participantForm' => $participantForm->createView()
            ]);
        }
        return $this->render('participant/profile.html.twig', [
            'participant' => $participant
        ]);
    }

}
