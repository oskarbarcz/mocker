<?php

namespace App\Fixture;

use App\Entity\Resource;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ResourceFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(0, 5) as $i) {
            $resource = new Resource();
            $resource->setName("Example $i")
                     ->setSlug("example-$i")
                     ->setDescription(
                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, at autem deleniti eius et facere, impedit ipsa magni nulla odio optio quos, repudiandae saepe sint sit soluta sunt tenetur veniam?'
                     )
                     ->setContent(json_encode(["a$i" => 'b']));

            $manager->persist($resource);
        }
        $manager->flush();
    }
}
