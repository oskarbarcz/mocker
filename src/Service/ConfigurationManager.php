<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Configuration;
use App\Repository\ConfigurationRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Handles behavior of configuration in app
 */
class ConfigurationManager
{
    private EntityManagerInterface $entityManager;
    private ConfigurationRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, ConfigurationRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    /**
     * Retrieves current configuration
     *
     * @return Configuration
     */
    public function get(): Configuration
    {
        // there can be only one element if this kind
        return $this->repository->findAll()[0];
    }

    /**
     * Purges previous config and sets new one
     *
     * @param Configuration $configuration
     */
    public function set(Configuration $configuration): void
    {
        $this->purgeCurrentSettings();
        $this->entityManager->persist($configuration);
        $this->entityManager->flush();
    }

    /**
     * Removes all stored current settings
     */
    private function purgeCurrentSettings(): void
    {
        $all = $this->repository->findAll();
        foreach ($all as $configuration) {
            $this->entityManager->remove($configuration);
        }
        $this->entityManager->flush();
    }
}
