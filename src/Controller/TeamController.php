<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TeamController extends AbstractController {
    #[Route('/team', name: 'team')]
    public function index(): Response {
        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }

    /**
     * @Route("/api/addEsportTeam")
     * @param Request $request
     * @return Response
     */
    public function addEsportTeam(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();
            $data = json_decode($request->getContent(), true);

            if (isset($data['teamName'])) $teamname = $data['teamName'] ?? $teamname = null;

            if (!isset($teamname)) return new Response("You have to provide a Fist-, Second Name", 400);

            $TEAM = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $teamname]);
            if (count($TEAM) >= 1) return new Response("This teamname is already  in use!", 400);
            if (count($TEAM) == 0) $teamID = null;

            $NewTeam = new Team();
            $NewTeam->setName($teamname);

            $entityManager->persist($NewTeam);
            $entityManager->flush();

            return new Response("successful", 200);
        }
    }

    /**
     * @Route("/api/getEsportTeam")
     * @param Request $request
     * @return Response
     */
    public function getEsportTeam(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();
            $data = json_decode($request->getContent(), true);

            if (!isset($data['teamName'])) return new Response("Please provide a team name", 400);

            $TEAM = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $data['teamName']]);
            if (count($TEAM) == 0) return new Response("Team not found", 400);
            if (count($TEAM) >= 1) $TEAM = $TEAM[0];

            $Personen = $this->getDoctrine()->getRepository(Team::class)->findBy(['id' => $TEAM->getId()]);

            return new Response($serializer->serialize($Personen, 'json'), 200);
        }
    }

}
