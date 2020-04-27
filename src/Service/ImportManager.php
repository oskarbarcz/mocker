<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\ApplicationContent;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Handles data import from file
 */
class ImportManager
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function import(File $file): void
    {
        $content = file_get_contents($file->getPathname());
        $object = $this->createImportObject($content);
        dd($object);
    }

    private function createImportObject(string $content): ApplicationContent
    {
        return $this->serializer->deserialize($content, ApplicationContent::class, 'json');
    }
}
