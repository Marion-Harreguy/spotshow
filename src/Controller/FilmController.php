<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/film", name="film_")
*/
class FilmController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SerieRepository $serieRepository)
    {   
        $series = $serieRepository->findBy([
            'type' => 'film'
        ]);

        return $this->render('film/index.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * @Route("/{id}", name="read", requirements={"id":"\d+"})
     */
    public function read(Serie $serie)
    {   
        return $this->render('film/read.html.twig', [
            'serie' => $serie,
        ]);
    }
}