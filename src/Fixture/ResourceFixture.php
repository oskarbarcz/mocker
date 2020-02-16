<?php

namespace App\Fixture;

use App\Entity\Resource;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ResourceFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $resource1 = new Resource();
        $resource1->setName('Example 1')
                  ->setSlug('example-1')
                  ->setContent(json_encode(['a' => 'b']));

        $resource2 = new Resource();
        $resource2->setName('Example 2')
                  ->setSlug('example-2')
                  ->setContent(json_encode(['a' => 'b']));

        $resource3 = new Resource();
        $resource3->setName('Example 3')
                  ->setSlug('example-3')
                  ->setContent(json_encode(['a' => 'b']));

        $resource4 = new Resource();
        $resource4->setName('Example 4')
                  ->setSlug('example-4')
                  ->setContent(json_encode(['a' => 'b']));

        $manager->persist($resource1);
        $manager->persist($resource2);
        $manager->persist($resource3);
        $manager->persist($resource4);
        $manager->flush();
    }
}
