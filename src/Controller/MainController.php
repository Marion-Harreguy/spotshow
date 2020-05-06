<?php

namespace App\Controller;

use App\Entity\Platform;
use App\Entity\Serie;
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
        $repository = $this->getDoctrine()->getRepository(Platform::class);

        $series = $serieRepository->findAll();

        return $this->render('main/browse.html.twig', [
            'series' => $series,
        ]);
    }
}
