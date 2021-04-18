<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\Cache\Persister\Collection\ReadOnlyCachedCollectionPersister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController {
    #[Route('/user', name: 'user')]
    public function index(): Response {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/api/registerUser")
     * @param Request $request
     * @return Response
     */
    public function registerUser(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();

            $data = json_decode($request->getContent(), true);
            $isCorrect = "";
            if (isset($data["Email"])) $email = $data['email'] ?? $isCorrect .= "email ";
            if (isset($data["password"])) $password = $data['password'] ?? $isCorrect .= "password";
            if (isset($data["rechte"])) $rechte = $data['rechte'] ?? $rechte = 0;

            if ($isCorrect != "") return new Response("You have to provide: " . $isCorrect);

            $USER = new User();
            $USER->setEmail($email);
            $USER->setRechte($rechte);
            $USER->setPasswort($password);

            $entityManager->persist($USER);
            $entityManager->flush();

            return new Response("successful", 200);
        }
    }

    /**
     * @Route("/api/loginUser")
     * @param Request $request
     * @return Response
     */
    public function loginUser(Request $request, SerializerInterface $serializer): Response {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();
            $data = json_decode($request->getContent(), true);
            $isCorrect = "";
            if (isset($data["Email"])) $email = $data['email'] ?? $isCorrect .= "email ";
            if (isset($data["password"])) $password = $data['password'] ?? $isCorrect .= "password";
            if (isset($data["rechte"])) $rechte = $data['rechte'] ?? $rechte = 0;

            if ($isCorrect != "") return new Response("You have to provide: " . $isCorrect);

            $USER = $this->getDoctrine()->getRepository(User::class)->findBy(['email' => $email]);
            if (count($USER) == 0) return new Response("Username or Password incorrect", 400);
            /** @var User $USER */
            $USER = $USER[0];

            if (!password_verify($password, $USER->getPasswort())) return new Response("Username or Password incorrect", 400);

            $returnData = [
                "rights" => $USER->getRechte()
            ];

            return new Response($serializer->serialize($returnData, 'json'), 200);
        }
    }
}
