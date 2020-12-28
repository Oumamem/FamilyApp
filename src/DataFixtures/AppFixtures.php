<?php

namespace App\DataFixtures;

use App\Entity\Famille;
use App\Entity\Souvenir;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Repository\SouvenirRepository;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $manager->flush();
    }



}
