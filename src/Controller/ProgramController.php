<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @return Response
 */
Class ProgramController extends AbstractController
{
    /**
     * @Route("/programs/", name="program_index")
     */
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }

    /**
     * @Route("/programs/{id}", requirements={"id"="\d+"}, methods={"GET"}, name="program_show")
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
            return $this->render('program/show.html.twig', [
                'id' => $id,
            ]);
    }
}