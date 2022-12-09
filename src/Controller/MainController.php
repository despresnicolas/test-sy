<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchFormType;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @param SortieRepository $sortieRepository
     * @param Request $request
     * @return Response
     * @Route("/", name="main_home")
     */
    public function index(
        SortieRepository $sortieRepository,
        Request $request
    ): Response
    {
        $searchData = new SearchData();
        $searchForm = $this->createForm(SearchFormType::class, $searchData);
        $searchForm->handleRequest($request);
        $sorties = $sortieRepository->findSearch($searchData);

        return $this->render('main/home.html.twig', [
            'sorties' => $sorties,
            'searchForm' => $searchForm->createView(),
        ]);
    }
}
