<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $categorie1 = new Categorie();
        $categorie1->setDesignation("amis");
        $manager->persist($categorie1);

        $categorie2 = new Categorie();
        $categorie2->setDesignation("connaissance");
        $manager->persist($categorie2);
        
        $categorie3 = new Categorie();
        $categorie3->setDesignation("professionnel");
        $manager->persist($categorie3);

        $cats = [$categorie1, $categorie2, $categorie3];

        $manager->flush();

        $faker = Factory::create('FR-fr');
        
        for($i = 1; $i <= 30; $i++)
        {
        
            $contact = new Contact();

            $image =$faker->imageUrl(80,80);
            $adresse=$faker->address;
            $prenom=$faker->name;
            $nom=$faker->lastName;
            $ville=$faker->city;
            $numtel=$faker->phoneNumber;
            $adressemail=$faker->email;
            $codepostal=$faker->countryCode;

            $contact->setNom($nom)
                    ->setPrenom($prenom)
                    ->setAdresse($adresse)
                    ->setVille($ville)
                    ->setNumtel($numtel)
                    ->setAdressemail($adressemail)
                    ->setCodepostal($codepostal)
                    ->setAvatar($image)
                    ->setCategorie($cats[mt_rand(0,2)]);

            $manager->persist($contact);


        
    }
    $manager->flush();
}
}
