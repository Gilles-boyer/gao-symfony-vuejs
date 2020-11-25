<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        
        for ($i=0; $i < 10; $i++) { 
            $client = New Client();
            $client ->setName($faker->name);
            $manager  ->persist($client);
            $manager  ->flush();
        }
    }
}
