<?php

namespace App\DataFixtures;

use App\Entity\Magasin;
use App\Entity\Marque;
use App\Entity\Produit;

use App\Entity\Stock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $marque1 = new Marque();
        $marque1->setNom("Apple");
        $manager->persist($marque1);

        $marque2 = new Marque();
        $marque2->setNom("Samsung");
        $manager->persist($marque2);

        $marque3 = new Marque();
        $marque3->setNom("Microsoft");
        $manager->persist($marque3);


        $magasin1 = new Magasin();
        $magasin1->setNom("Lyon");
        $manager->persist($magasin1);

        $magasin2 = new Magasin();
        $magasin2->setNom("Paris");
        $manager->persist($magasin2);

        $magasin3 = new Magasin();
        $magasin3->setNom("Bordeaux");
        $manager->persist($magasin3);

        $magasin4 = new Magasin();
        $magasin4->setNom("Toulouse");
        $manager->persist($magasin4);

        $magasin5 = new Magasin();
        $magasin5->setNom("Lille");
        $manager->persist($magasin5);

        $magasins = [1 => $magasin1, 2 => $magasin2, 3 => $magasin3, 4 => $magasin4, 5 => $magasin5];

        $faker = Faker\Factory::create('fr_FR'); // Instance Faker
        for ($i = 0; $i < 100; $i++) {
            $produit = new Produit();
            $produit->setTitre($faker->randomElement(['Lave Vaisselle','Grille Pain','TV 110 Cm','Aspirateur','Ordinateur','Tablette','Smartphone','Cafetiere','Lave Linge','Robot Ménager' ]))
                ->setCouleur($faker->numberBetween(1,10))
                ->setDescription($faker->sentence(20, true))
                ->setPoids($faker->randomFloat($nbMaxDecimals = 2, $min = 2, $max = 500))
                ->setPrixTTC($faker->randomNumber(4))
                ->setActif($faker->randomElement([true,false]))
                ->setMarque($faker->randomElement([$marque1, $marque2, $marque3]))
                ->setStockQte($faker->randomNumber(2));
            $manager->persist($produit);
            foreach ($magasins as $magasin){
                $stock = new Stock();
                $stock->setMagasin($magasin)->setProduit($produit)->setQte($faker->numberBetween(0,70));
                $manager->persist($stock);
            }
        }
        $manager->flush();





        //for ($i = 0; $i < 100; $i++) {
            //$produit = $manager->getRepository('App:Produit')->findOneBy(['id' => $i]);

        //}

        //$manager->flush();
    }
}
