<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="category_")
 */
Class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
     * @Route("/{categoryName}", name="show")
     * @param string $categoryName
     * @return Response
     */
    public function show(string $categoryName): Response
    {
        $categoryName = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' =>$categoryName], ['id' => 'DESC'], 3);

        if (!$categoryName) {
            throw $this->createNotFoundException(
                'No program with categoryName : '.$categoryName.' found in program\'s table.'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $categoryName,
            'programs' => $programs
        ]);
    }


}
