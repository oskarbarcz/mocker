<?php declare(strict_types=1);

namespace App\ValueObject;

use App\Entity\Config;
use DateTime;

/**
 * Stores an image of application settings
 */
class ApplicationContent
{
    private ?Config $config = null;
    private array $resources = [];
    private string $version = '1.0.0';
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function setConfig(Config $config): ApplicationContent
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
