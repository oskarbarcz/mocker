<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Resource;
use App\Exception\ValidationException;
use App\Repository\ResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Facade for resource manipulation tools
 *
 * @package App\Service
 */
class ResourceManager
{
    private EntityManagerInterface $entityManager;
    private ResourceRepository $resourceRepository;
    private ValidatorInterface $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        ResourceRepository $resourceRepository,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->resourceRepository = $resourceRepository;
        $this->validator = $validator;
    }

    /**
     * Get one resource
     *
     * @param string $slug
     *
     * @return Resource|null
     */
    public function getOne(string $slug): ?Resource
    {
        return $this->resourceRepository->findOneBy(['slug' => $slug]);
    }

    /**
     * Returns all available resources
     *
     * @return Resource[]
     */
    public function getAll(): array
    {
        return $this->resourceRepository->findAll();
    }

    /**
     * Creates or updates a resource
     *
     * @param Resource $resource
     *
     * @return Resource
     * @throws ValidationException
     */
    public function persist(Resource $resource, bool $throwOnError = false): Resource
    {
        if ($throwOnError) {
            $this->validate($resource);
        }

        $this->entityManager->persist($resource);
        $this->entityManager->flush();

        return $resource;
    }

    /**
     * Removes a resource
     *
     * @param Resource $resource
     */
    public function delete(Resource $resource): void
    {
        $this->entityManager->remove($resource);
        $this->entityManager->flush();
    }

    /**
     * @param Resource $resource
     *
     * @throws ValidationException
     */
    private function validate(Resource $resource): void
    {
        $violations = $this->validator->validate($resource);

        if (count($violations) === 0) {
            return;
        }

        throw new ValidationException($violations);
    }
}
