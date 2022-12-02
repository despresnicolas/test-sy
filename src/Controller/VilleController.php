<?php

namespace App\Controller;

use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    /**
     * @Route("/villes", name="villes_main")
     */
    public function main(VilleRepository $villeRepository): Response
    {
        $villes = $villeRepository->findAll();
        return $this->render('villes/main.html.twig', [
            'controller_name' => 'VilleController',
            'villes' => $villes,
        ]);
    }
}
