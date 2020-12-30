<?php


namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use  Faker;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for($i = 0; $i <= 10; $i++) {
            $episode = new Episode();
            $episode->setTitle($faker->title);
            $episode->setNumber($faker->randomDigit);
            $episode->setSynopsis($faker->text(200));
            $episode->setSeason($this->getReference('season' . rand(0,5)));
            $manager->persist($episode);
            $this->addReference('episode' . $i, $episode);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        // TODO: Implement getDependencies() method.
        return [SeasonFixtures::class];
    }
}