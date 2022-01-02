<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProgramController.php',
        ]);
    }

    #[Route('/{id}', methods: ['get'], requirements: ['id' => '\d+'], name: 'show')]
    public function show(int $id): Response
    {

        return $this->render('program/show.html.twig', [
            'id' => $id
        ]);
    }
}
