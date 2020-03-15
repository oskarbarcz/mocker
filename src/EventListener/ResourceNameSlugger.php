<?php declare(strict_types=1);

namespace App\EventListener;

use App\Entity\Resource;
use App\Repository\ResourceRepository;
use Symfony\Component\String\Slugger\SluggerInterface;

class ResourceNameSlugger
{
    private SluggerInterface $slugger;
    private ResourceRepository $repository;

    public function __construct(SluggerInterface $slugger, ResourceRepository $repository)
    {
        $this->slugger = $slugger;
        $this->repository = $repository;
    }

    /**
     * @param Resource $resource
     */
    public function prePersist(Resource $resource): void
    {
        $slug = $resource->getSlug();
        if ($this->repository->isSlugFree($slug)) {
            // if slug is set and is free
            $resource->setSlug($slug);
        }

        $this->autogenerate($resource);
    }

    public function autogenerate(Resource $resource): void
    {
        $preslug = $resource->getSlug() ?? $resource->getName();

        $iteration = 0;
        do {
            $postfix = $iteration === 0 ? '' : '-1';
            $slug = $this->slugger->slug($preslug . $postfix);
            $resource->setSlug($slug->toString());

            $iteration++;
        } while (!$this->repository->isSlugFree($resource->getSlug()));
    }
}
