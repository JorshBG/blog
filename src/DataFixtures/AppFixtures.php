<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\CommentFactory;
use App\Factory\PostFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        UserFactory::createMany(10);
        UserFactory::createOne(['email' => 'jordiyair29@gmail.com', 'roles' => ['ROLE_ADMIN'], 'password' => 'Jordi29+']);
        CategoryFactory::createMany(10);

        UserFactory::createMany(5, function () {
            return [
                'friends' => UserFactory::randomRange(1, 3),
            ];
        });

        PostFactory::createMany(50, function () {
            return [
                'author' => UserFactory::random(),
                'categories' => CategoryFactory::randomRange(2, 4),
                'comments' => CommentFactory::new([
                    'author' => UserFactory::random(),
                    'loves' => UserFactory::randomRange(1, 3),
                ])->many(1, 2),
            ];
        });

        $manager->flush();
    }
}
