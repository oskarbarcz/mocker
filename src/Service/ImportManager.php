<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\ApplicationContent;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Handles data import from file
 */
class ImportManager
{
    private SerializerInterface $serializer;
    private ResourceManager $resourceManager;
    private ConfigurationManager $configurationManager;

    public function __construct(
        SerializerInterface $serializer,
        ResourceManager $resourceManager,
        ConfigurationManager $configurationManager
    ) {
        $this->serializer = $serializer;
        $this->resourceManager = $resourceManager;
        $this->configurationManager = $configurationManager;
    }

    public function import(File $file): void
    {
        $content = file_get_contents($file->getPathname());
        $object = $this->createImportObject($content);

        $this->clearAllPrevious();
        $this->importNew($object);
    }

    private function createImportObject(string $content): ApplicationContent
    {
        return $this->serializer->deserialize($content, ApplicationContent::class, 'json');
    }

    public function clearAllPrevious(): void
    {
        $resources = $this->resourceManager->getAll();

        foreach ($resources as $resource) {
            $this->resourceManager->delete($resource);
        }
    }

    private function importNew(ApplicationContent $object): void
    {
        $resources = $object->getResources();

        foreach ($resources as $resource) {
            $this->resourceManager->persist($resource);
        }

        $this->configurationManager->set($object->getConfig());
    }
}
