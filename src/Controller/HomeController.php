<?php

namespace App\Controller;

use App\Service\Matches;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    #[Route('/home', name: 'home')]
    public function index(Matches $matchesService): Response {

        $match = $matchesService->getMatches();
        $data ['matches'] = $match;

        return $this->render('home/index.html.twig', $data);
    }

    #[Route('/match', name: 'home')]
    public function match(): Response {

        return $this->render('home/index.html.twig', []);
    }

}
