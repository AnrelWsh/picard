<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 50; $i++) { 
            $product = new Product();
            $product->setName($faker->word(3, true))
                    ->setDescription($faker->sentence(30))
                    ->setPrice($faker->randomNumber(2))
                    ->setRate($faker->numberBetween(1, 5))
                    ->setAvailable($faker->boolean);

            $manager->persist($product);
        }

        $manager->flush();
    }
}