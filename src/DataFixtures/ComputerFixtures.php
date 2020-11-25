<?php

namespace App\DataFixtures;

use App\Entity\Computer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ComputerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 10; $i++) { 
            $computer = New Computer();
            $computer ->setName('PC '.$i);
            $manager  ->persist($computer);
            $manager  ->flush();
        }
    }
}
