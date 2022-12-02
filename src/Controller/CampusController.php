<?php

namespace App\Controller;

use App\Repository\CampusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * @Route("/campus", name="campus_main")
     */
    public function main(CampusRepository $campusRepository): Response
    {
        $campus = $campusRepository->findAll();
        return $this->render('campus/main.html.twig', [
            'controller_name' => 'CampusController',
            'campus' => $campus,
        ]);
    }
}
