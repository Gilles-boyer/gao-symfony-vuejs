<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    /**
     * @Route("/api/client/getAll", name="clientGetAll", methods={"GET"})
     */
    public function index(ClientRepository $clients): Response
    {
        return $this->json($clients->findAll(), 200, [], ['groups' => 'client']);
    }

    /**
     * @Route("/api/client/create", name="clientCreate", methods={"POST"})
     */
    public function store(
        Request $request, 
        EntityManagerInterface $em, 
        SerializerInterface $serializerInterface, 
        ValidatorInterface $validator ): Response
    {
        $dataClient = $serializerInterface->deserialize($request->getContent(), Client::class, 'json');

        $errors = $validator->validate($dataClient);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $client = New Client();
        
        $client->setName($dataClient->getName());

        $em->persist($client);
        $em->flush();

        return $this->json([
            'error' => false,
            'computer' => $client,
            'message' => "Le client est créé"
        ], 200);
    }
}
