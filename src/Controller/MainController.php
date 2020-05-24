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
     * @Route("/", name="browse")
     */
    public function browse(SerieRepository $serieRepository)
    {   
        $series = $serieRepository->findAll();

        return $this->render('main/browse.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * @Route("/{id}", name="read", requirements={"id":"\d+"})
     */
    public function read(Serie $serie)
    {   
        return $this->render('main/read.html.twig', [
            'serie' => $serie,
        ]);
    }

    /**
     * @Route("/{id}", name="edit", requirements={"id":"\d+"})
     */
    public function edit(EntityManagerInterface $em, Request $request, Serie $serie)
    {   
        $form = $this->createForm(SerieType::class, $serie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $serie->setUpdatedAt(new \Datetime());

            $em->flush();

            $this->addFlash('success', "Updated, Good job !");

            return $this->redirectToRoute('main_read', ['id' => $serie->getId()]);
        }

        return $this->render('main/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
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

            $this->addFlash('success', "Added, Good job !");

            return $this->redirectToRoute('main_browse');
        }

        return $this->render('main/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
