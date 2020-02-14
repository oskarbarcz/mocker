<?php

namespace App\DataFixtures;

use App\Entity\Resource;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ResourceFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $resource = new Resource();
        $resource->setName('Example')
                 ->setSlug('example')
                 ->setContent(['a' => 'b'])
                 ->setUuid('unique-id');

        $manager->persist($resource);
        $manager->flush();
    }
}
