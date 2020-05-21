<?php

namespace App\Controller;

use App\Entity\Platform;
use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\PlatformRepository;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/", name="main_")
*/
class MainController extends AbstractController
{
    /**
     * Fonction qui liste toutes les séries et tous les films
     * 
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(SerieRepository $serieRepository)
    {   
        $series = $serieRepository->findAll();

        return $this->render('main/browse.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * Fonction permettant d'ajouter une série ou un film
     * 
     * @Route("/series", name="add")
     */
    public function add(EntityManagerInterface $em, Request $request, SerieRepository $serieRepository)
    {   
        // on récupère les datas de $serieRepository avec les genres classés par ordre alphabétique
        $series = $serieRepository->findAllByGenre();
        
        $serie = new Serie();

        $form = $this->createForm(SerieType::class, $serie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($serie);
            $em->flush();

            $this->addFlash('success', "Good job !");

            // return $this->redirectToRoute('main_browse');
        }

        // $error = $form->getErrors();

        return $this->render('main/add.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
