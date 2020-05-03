<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/", name="main_")
*/
class MainController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(SerieRepository $serieRepository)
    {
        return $this->render('main/browse.html.twig', [
            'series' => $serieRepository->findAll(),
        ]);
    }
}
