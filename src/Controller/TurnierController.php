<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Team;
use App\Entity\Turnier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TurnierController extends AbstractController {
    #[Route('/turnier', name: 'turnier')]
    public function index(): Response {
        return $this->render('turnier/index.html.twig', [
            'controller_name' => 'TurnierController',
        ]);
    }

    /**
     * @Route("/api/addEsportTournamentRound")
     * @param Request $request
     * @return Response
     */
    public function addEsportTournamentRound(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();
            $data = json_decode($request->getContent(), true);

            if (isset($data['game'])) $game = $data['game'] ?? $game = null;
            if (isset($data['teamName1'])) $teamName1 = $data['teamName1'] ?? $teamName1 = null;
            if (isset($data['teamName2'])) $teamName2 = $data['teamName2'] ?? $teamName2 = null;
            if (isset($data['teamNameWinner'])) $teamNameWinner = $data['teamNameWinner'] ?? $teamNameWinner = null;
            if (isset($data['price'])) $price = $data['price'] ?? $price = "honor";
            if (isset($data['startingTime'])) $startingTime = $data['startingTime'] ?? $startingTime = null;

            if (!isset($game) || !isset($teamName1) || !isset($teamName2)) return new Response("You have to provide a Game-, Team 1- and Team 2 Name", 400);

            $TEAM1 = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $teamName1]);
            $TEAM2 = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $teamName2]);
            if (isset($teamNameWinner)) $TEAMwinner = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $teamNameWinner]);

            if (count($TEAM1) == 0) return new Response("Team 1 not found");
            if (count($TEAM1) == 1) $TEAM1 = $TEAM1[0];
            if (count($TEAM2) == 0) return new Response("Team 2 not found");
            if (count($TEAM2) == 1) $TEAM2 = $TEAM2[0];
            if (count($TEAMwinner) == 0) return new Response("Winning Team not found");
            if (count($TEAMwinner) == 1) $TEAMwinner = $TEAMwinner[0];

            $TURNIER = new Turnier();
            $TURNIER->setPrice($price);
            $TURNIER->setGame($game);
            $TURNIER->setFKTeam1ID($teamName1->getID());
            $TURNIER->setFKTeam2ID($teamName2->getID());
            $TURNIER->setFKWinnerID($teamNameWinner->getID());
            $TURNIER->setStartingTime(new \DateTime("today")); //TODO

            $entityManager->persist($TURNIER);
            $entityManager->flush();

            return new Response("successful", 200);
        }
    }

    /**
     * @Route("/api/getEsportTournamentRound")
     * @param Request $request
     * @return Response
     */
    public function getEsportTournamentRound(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {
            $data = json_decode($request->getContent(), true);

            if (isset($data['id'])) {
                $id = $data['id'];
            } else {
                return new Response("You have to provide an id");
            }

            $erg = $this->getTournaments()['id'];
            return new Response($serializer->serialize($erg, 'json'), 200);
        }
    }

    /**
     * @Route("/api/getAllEsportTournamentRounds")
     * @param Request $request
     * @return Response
     */
    public function getAllEsportTournamentRounds(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {

            $erg = $this->getTournaments();
            return new Response($serializer->serialize($erg, 'json'), 200);
        }
    }

    private function getTournaments() {
        $data = $this->getDoctrine()->getRepository(Turnier::class)->findAll();
        $erg1 = [];

        /** @var Turnier $round */
        foreach ($data as $round) {
            $erg2 = [];
            /** @var Team $TEAM1 */
            $TEAM1 = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $round->getFKTeam1ID()]);
            $TEAM2 = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $round->getFKTeam2ID()]);
            $TEAMw = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $round->getFKWinnerID()]);
            if (count($TEAMw) == 0) {
                $teamW = [
                    'name' => $TEAM1->getName(),
                    'persons' => $this->getDoctrine()->getRepository(Person::class)->findBy(['id' => $TEAM1->getID()])
                ];
            } else {
                $teamW = "not yet held";
            }
            /** @var Team $team */
            foreach ([$TEAM1, $TEAM2, $TEAMw] as $team) {
                $erg3 = [];
                $erg3['personen'] = $this->getDoctrine()->getRepository(Person::class)->findBy(['id' => $team->getID()]);
                $erg3['name'] = $team->getName();
                $erg3['id'] = $team->getId();

                array_push($erg2, $erg3);
            }
            $erg2 = [
                'game' => $round->getGame(),
                'price' => $round->getPrice(),
                'startingTime' => $round->getStartingTime(),
                'team1' => [
                    'name' => $TEAM1->getName(),
                    'persons' => $this->getDoctrine()->getRepository(Person::class)->findBy(['id' => $TEAM1->getID()])
                ],
                'team2' => [
                    'name' => $TEAM1->getName(),
                    'persons' => $this->getDoctrine()->getRepository(Person::class)->findBy(['id' => $TEAM1->getID()])
                ],
                'winnerTeam' => $teamW
            ];

            $erg1[$round->getId()] = $erg2;
        }

        return $erg1;
    }

}
