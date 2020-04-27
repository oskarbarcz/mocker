<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Entity\Configuration;
use DateTime;
use JMS\Serializer\Annotation as Serializer;

/**
 * Stores an image of application settings
 */
class ApplicationContent
{
    /** @Serializer\Type("App\Entity\Configuration") */
    private ?Configuration $config = null;

    /** @Serializer\Type("array<App\Entity\Resource>") */
    private array $resources = [];

    /** @Serializer\Type("string") */
    private string $version = '1.0.0';

    /** @Serializer\Type("DateTime") */
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getConfig(): Configuration
    {
        return $this->config;
    }

    public function setConfig(Configuration $config): ApplicationContent
    {
        $this->config = $config;
        return $this;
    }

    public function getResources(): array
    {
        return $this->resources;
    }

    public function setResources(array $resources): ApplicationContent
    {
        $this->resources = $resources;
        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): ApplicationContent
    {
        $this->version = $version;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): ApplicationContent
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
