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

    #[Route('/match/{team1}-vs-{team2}', name: 'home')]
    public function match(string $team1, string $team2, Matches $matchesService): Response {

        $data = $matchesService->getMatches();
        foreach ($data as $match) {
//            return new Response(strtolower($match['teams'][1]["name"]) . " xx " . $team2);
            if (strtolower($match['teams'][0]["name"]) == strtolower($team1) && strtolower($match['teams'][1]["name"]) == strtolower($team2) || strtolower($match['teams'][1]["name"]) == strtolower($team1) && strtolower($match['teams'][2]["name"]) == strtolower($team2)) {
                $erg = $match;
            }
        }
        if (!isset($erg)) return new Response("Match not found");

        $tmp["matches"][0] = $erg;
//        return new Response(json_encode($data));
        return $this->render('home/index.html.twig', $tmp);
    }

}
