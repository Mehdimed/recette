<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
        $aliments = ['banane','orange', 'carotte', 'cerise', 'champignon', 'choufleur', 'clementine', 'fenouil', 'fraise', 'haricot', 'poire', 'poireau', 'pomme', 'tomate'];

        foreach ($aliments as $key => $value) {

            $product = new Aliment();
            $product->setNom($value)
            ->setImage('images/'.$value.'.jpg')
            ->setPrix(rand(3, 25))
            ->setCalories(rand(50, 400))
            ->setProteines(rand(50, 400))
            ->setGlucides(rand(50, 400))
            ->setLipides(rand(50, 400));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
