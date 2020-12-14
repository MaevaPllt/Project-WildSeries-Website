<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actors", name="actor_")
 */
Class ActorController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();

        return $this->render(
            'actor/index.html.twig',
            ['actors' => $actors]
        );
    }


    /**
     * @Route("/{id}", name="show")
     * @param Actor $actor
     * @return Response
     */
    public function show(Actor $actor): Response
    {
        $programs = $actor->getPrograms();
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            'programs' => $programs,
        ]);
    }


}
