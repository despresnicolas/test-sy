<?php

namespace App\Controller;

use App\Repository\CampusRepository;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function index(SortieRepository $sortieRepository, CampusRepository $campusRepository): Response
    {
        $sorties = $sortieRepository->findAll();
        $campus = $campusRepository->findAll();
        return $this->render('main/home.html.twig', [

            'controller_name' => 'MainController',
            'sorties' => $sorties,
            'campus' => $campus,
        ]);
    }
}
