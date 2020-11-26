<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Client;
use App\Entity\Computer;
use App\Entity\Attribution;
use App\Controller\ComputerController;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AttributionFixtures extends Fixture
{
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

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
        $user = New User('boyer.gilles@live.fr');

        $user->setEmail('boyer.gilles@live.fr');
        $user->setPassword($this->encoder->encodePassword($user, "password"));
        $manager->persist($user);
        $manager  ->flush();
    }
}
