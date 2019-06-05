<?php


namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [CategoryFixtures::class];

    }
public function load(ObjectManager $manager)
{
    $faker = Faker\Factory::create('en_US');


    for ($i = 1; $i <= 50; $i++) {
        $article = new article();
        //$article->setTitle('Framework PHP : symfony4' . $i);
        $article->setTitle(mb_strtolower($faker->sentence()));
        $article->setContent(mb_strtolower($faker->text));
        $manager->persist($article);
        $article->setCategory($this->getReference('categorie_0'));
        // categorie_0 fait reference à la premiere categorie générée.

    }
    $manager->flush();
}


}