<?php

namespace App\Controller;

use DateTime;
use App\Entity\Attribution;
use App\Repository\ClientRepository;
use App\Repository\ComputerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AttributionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints as Assert;

class AttributionController extends AbstractController
{
    /**
     * @Route("api/attribution/create", name="attributionCreate", methods={"POST"})
     */
    public function store(
        Request $request,
        SerializerInterface $serializerInterface,
        ClientRepository $client,
        ComputerRepository $computer,
        ValidatorInterface $validator,
        EntityManagerInterface $em
    ): Response {
        $data = $request->getContent();

        $dataRequest = $serializerInterface->deserialize($data, DataAttribution::class, 'json');

        $errors = $validator->validate($dataRequest);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $attribution = new Attribution;

        $date = new DateTime($dataRequest->getDate());

        $attribution->setTime($dataRequest->getTime());
        $attribution->setDate($date);
        $attribution->setClient(
            $client->find($dataRequest->getClient())
        );
        $attribution->setComputer(
            $computer->find($dataRequest->getComputer())
        );

        $em->persist($attribution);
        $em->flush();

        return $this->json([
            "error" => false,
            "data" => $attribution,
            "message" => "Attribution créée"
        ], 200, [], ['groups' => "attribution"]);
    }

    /**
     * @Route("/api/attribution/delete", name="attributionDelete" , methods={"POST"},)
     * 
     */
    public function destroy(
        Request $request, 
        EntityManagerInterface $em, 
        SerializerInterface $serializerInterface, 
        AttributionRepository $attribution): Response
    {

        $dataRequest = $serializerInterface->deserialize($request->getContent(), DataAttribution::class, 'json');

        $delete = $attribution->find($dataRequest->getId());

        $em->remove($delete);
        $em->flush();
        
        return $this->json([
            'error' => false,
            'message' => "L'ordinateur est supprimé"
        ], 200);
    }
    
}














class DataAttribution
{
    private $id;
    /**
     * @Assert\NotBlank
     * @Assert\Date
     * @var string A "Y-m-d" formatted value
     */
    private $date;

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\LessThanOrEqual(
     *     value = 18
     * )
     * @Assert\GreaterThanOrEqual(
     *     value = 8
     * )
     */
    private $time;

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * 
     */
    private $client;

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $computer;

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of time
     */
    public function getTime()
    {
        return $this->time;
    }


    /**
     * Set the value of time
     *
     * @return  self
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @return  self
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get the value of computer
     */
    public function getComputer()
    {
        return $this->computer;
    }

    /**
     * Set the value of computer
     *
     * @return  self
     */
    public function setComputer($computer)
    {
        $this->computer = $computer;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
