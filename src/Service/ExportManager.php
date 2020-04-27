<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Configuration;
use App\Service\File\{FileManipulator, ManipulatorBuilder, Strategy\ApplicationContentStrategy};
use App\ValueObject\ApplicationContent;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class used for importing and exporting data from app
 */
class ExportManager
{
    private ResourceManager $resourceManager;
    private ConfigurationManager $configurationManager;
    private SerializerInterface $serializer;
    private FileManipulator $manipulator;

    public function __construct(
        ResourceManager $resourceManager,
        ConfigurationManager $configurationManager,
        SerializerInterface $serializer,
        ApplicationContentStrategy $contentStrategy
    ) {
        $this->resourceManager = $resourceManager;
        $this->configurationManager = $configurationManager;
        $this->manipulator = ManipulatorBuilder::fromStrategy($contentStrategy);
        $this->serializer = $serializer;
    }

    /**
     * Prepare file to export
     */
    public function export(): File
    {
        $data = $this->createData(
            $this->resourceManager->getAll(),
            $this->configurationManager->get()
        );

        $serialized = $this->serializer->serialize($data, 'json');
        $this->manipulator->create($serialized);

        return $this->manipulator->get();
    }

    /**
     * Builds complete content object from partials
     *
     * @param array         $resources
     * @param Configuration $configuration
     *
     * @return ApplicationContent
     */
    private function createData(array $resources, Configuration $configuration): ApplicationContent
    {
        $data = new ApplicationContent();
        $data->setConfig($configuration)
            ->setResources($resources);

        return $data;
    }

    /**
     * Import data from file to app
     *
     * @param File $file
     */
    public function import(File $file): void
    {
    }
}
