<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Client;
use App\Entity\Computer;
use App\Entity\Attribution;
use App\Controller\ComputerController;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AttributionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $date = new DateTime();
        $date->format('Y-m-d');
        
        for ($i=0; $i < 5; $i++) {
            $client = New Client();
            $client ->setName($faker->name);
            $manager  ->persist($client);
            $manager  ->flush();

            $computer = New Computer();
            $computer ->setName('PC '.$i);
            $manager  ->persist($computer);
            $manager  ->flush();

            $attribution = New Attribution();
            $attribution ->setDate($date);
            $attribution ->setTime($faker->numberBetween($min = 8, $max = 18));
            $attribution->setComputer($computer);
            $attribution->setClient($client);
            $manager  ->persist($attribution);
            $manager  ->flush();
        }
    }
}
