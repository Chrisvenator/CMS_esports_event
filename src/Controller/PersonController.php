<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PersonController extends AbstractController {
    #[Route('/person', name: 'person')]
    public function index(): Response {
        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }

    /**
     * @Route("/api/addEsportPlayer")
     * @param Request $request
     * @return Response
     */
    public function addEsportPlayer(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();
            $data = json_decode($request->getContent(), true);

            if (isset($data['firstName'])) $vorname = $data['firstName'] ?? $vorname = null;
            if (isset($data['lasName'])) $nachname = $data['lastName'] ?? $nachname = null;
            if (isset($data['kd'])) $kd = $data['kd'] ?? $kd = null;
            if (isset($data['teamName'])) $teamname = $data['teamName'] ?? $teamname = null;

            if (!isset($vorname) || !isset($nachname)) return new Response("You have to provide a Fist-, Second Name", 400);

            if (count($this->getDoctrine()->getRepository(Person::class)->findBy(['Vorname' => $vorname, 'Nachname' => $nachname])) != 0) return new Response("This Person already exists");
            $TEAM = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $teamname]);
            if (count($TEAM) > 1) return new Response("Error! Too many Teams with this name found!", 400);
            if (count($TEAM) == 1) $teamID = $TEAM[0]->getID();
            if (count($TEAM) == 0) $teamID = null;

            $PERSON = new Person();
            $PERSON->setVorname($vorname);
            $PERSON->setNachname($nachname);
            $PERSON->setKD($kd);
            $PERSON->setFKTeamID($teamID);

            $entityManager->persist($PERSON);
            $entityManager->flush();

            return new Response("successful", 200);
        }
    }

    /**
     * @Route("/api/getEsportPlayer")
     * @param Request $request
     * @return Response
     */
    public function getEsportPlayer(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {
//            $entityManager = $this->getDoctrine()->getManager();
//            $data = json_decode($request->getContent(), true);
//
//            if (isset($data['firstName'])) $vorname = $data['firstName'] ?? $vorname = null;
//            if (isset($data['lasName'])) $nachname = $data['lastName'] ?? $nachname = null;
//            if (isset($data['kd'])) $kd = $data['kd'] ?? $kd = null;
//            if (isset($data['teamName'])) $teamname = $data['teamName'] ?? $teamname = null;
//
//            if (!isset($vorname) || !isset($nachname)) return new Response("You have to provide a Fist-, Second Name", 400);
//
//            if (count($this->getDoctrine()->getRepository(Person::class)->findBy(['Vorname' => $vorname, 'Nachname' => $nachname])) != 0) return new Response("This Person already exists");
//            $TEAM = $this->getDoctrine()->getRepository(Team::class)->findBy(['name' => $teamname]);
//            if (count($TEAM) > 1) return new Response("Error! Too many Teams with this name found!", 400);
//            if (count($TEAM) == 1) $teamID = $TEAM[0]->getID();
//            if (count($TEAM) == 0) $teamID = null;
//
//            $PERSON = new Person();
//            $PERSON->setVorname($vorname);
//            $PERSON->setNachname($nachname);
//            $PERSON->setKD($kd);
//            $PERSON->setFKTeamID($teamID);
//
//            $entityManager->persist($PERSON);
//            $entityManager->flush();
            // TODO
        }
    }

}
