<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/serie", name="serie_")
*/
class SerieController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SerieRepository $serieRepository)
    {   
        $series = $serieRepository->findBy([
            'type' => 'serie'
        ]);

        return $this->render('serie/index.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * @Route("/{id}", name="read", requirements={"id":"\d+"})
     */
    public function read(Serie $serie)
    {   
        return $this->render('serie/read.html.twig', [
            'serie' => $serie,
        ]);
    }
}