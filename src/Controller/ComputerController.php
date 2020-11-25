<?php

namespace App\Controller;

use App\Entity\Computer;
use App\Repository\ComputerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComputerController extends AbstractController
{
    /**
     * @Route("/api/computer/getAll/{date}", name="computerGetAll" , methods="GET")
     * 
     */
    public function index($date,ComputerRepository $computerRepository): Response
    {
        $computer = new Computer;

        $computer::$date = $date;
        
        $test = $computerRepository->findAll();

        return $this->json($test ,200,[],['groups' => 'show_product']);
    }

    /**
     * @Route("/api/computer/create", name="computerCreate" , methods={"POST"})
     * 
     */
    public function createComputer(
        Request $request, 
        SerializerInterface $serializerInterface, 
        EntityManagerInterface $em, 
        ValidatorInterface $validator ): Response
    {
        $dataNewComputer = $serializerInterface->deserialize($request->getContent(), Computer::class, 'json');
        
        $errors = $validator->validate($dataNewComputer);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $computer = new Computer;

        $computer->setName($dataNewComputer->getName());

        $em->persist($computer);
        $em->flush();

        return $this->json([
            'error' => false,
            'computer' => $computer,
            'message' => "L'ordinateur est créé"
        ], 200);
    }

    /**
     * @Route("/api/computer/delete/{id}", name="computerDelete" , methods={"GET"})
     * 
     */
    public function destroy(Computer $computer, EntityManagerInterface $em): Response
    {
        $em->remove($computer);
        $em->flush();
        
        return $this->json([
            'error' => false,
            'computer' => $computer,
            'message' => "L'ordinateur est supprimé"
        ], 200);
    }

}
