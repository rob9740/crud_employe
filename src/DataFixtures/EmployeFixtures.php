<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Employe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EmployeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1 ; $i < 10 ; $i++){

            $employe = new Employe;

            // $product = new Product();

            $employe->setPrenom("Prenom de l'employé n°$i")
                    ->setNom("Nom de l'employé n°$i")
                    ->setTelephone("063425$i")
                    ->setEmail("email$i@gmail.com")
                    ->setAdresse("0$i rue du pave")
                    ->setPoste("commercial")
                    ->setSalaire(2000 * $i)
                    ->setDateDeNaissance("25-12-1985");

            // $manager->persist($product);
            $manager->persist($employe);

        }
        
            $manager->flush($employe);
         
        
    }
}
