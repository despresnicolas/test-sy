<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\CreateSortieType;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @param ParticipantRepository $participantRepository
     * @param Request $request
     * @return Response
     * @Route("/sortie/new", name="sortie_new")
     */
    public function new(
        ParticipantRepository $participantRepository,
        Request               $request
    ): Response
    {
        $organisateur = $participantRepository->find($this->getUser());

        $sortie = new Sortie();
        $sortie->setSiteOrganisateur($organisateur->getCampus());

        $createSortieForm = $this->createForm(CreateSortieType::class, $sortie);
        $createSortieForm->handleRequest($request);

        $sortie->setOrganisateur($organisateur);

        return $this->render('sortie/new.html.twig', [
            'createSortieForm' => $createSortieForm->createView(),
            'sortie' => $sortie,
        ]);
    }

    /**
     * @Route("/sortie/{id}", name="sortie_details")
     */
    public function details(int $id, SortieRepository $sortieRepository): Response
    {
        $sortie = $sortieRepository->find($id);

        return $this->render('sortie/details.html.twig', [
            'sortie' => $sortie,
        ]);
    }


}
