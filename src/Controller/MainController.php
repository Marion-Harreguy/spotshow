<?php

namespace App\Controller;

use App\Entity\Platform;
use App\Entity\Serie;
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
        $repository = $this->getDoctrine()->getRepository(Platform::class);

        $series = $serieRepository->findAll();

        return $this->render('main/browse.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * @Route("/series", name="add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {   
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);

        $form->handleRequest($request);

        if($form->isSubmitted() & $form->isValid()) {
            $em->persist($serie);
            $em->flush();

            return $this->redirectToRoute('');
        }

        return $this->render('main/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
