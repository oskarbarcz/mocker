<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Config;
use App\Repository\ConfigRepository;
use Doctrine\ORM\EntityManagerInterface;

class ConfigurationManager
{
    private EntityManagerInterface $entityManager;
    private ConfigRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, ConfigRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function initConfigOnEmpty()
    {
        // check if config does not exist

        $config = new Config();
        $this->entityManager->persist($config);
        $this->entityManager->flush();
    }
}
