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
     * This function will also create new when needed, or purge current if data failure is detected
     *
     * @return Configuration
     */
    public function get(): Configuration
    {
        $configuration = $this->repository->findAll();

        if (count($configuration) < 1) {
            return $this->setDefaultConfig();
        }

        if (count($configuration) > 1) {
            $this->purgeCurrentSettings();
            return $this->setDefaultConfig();
        }

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

    private function setDefaultConfig(): Configuration
    {
        $configuration = new Configuration();
        $this->entityManager->persist($configuration);
        $this->entityManager->flush();

        return $configuration;
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
