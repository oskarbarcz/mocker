<?php declare(strict_types=1);

namespace App\Twig;

use App\Service\ConfigurationManager;
use RuntimeException;

/**
 * Allows configutation to be loaded directly from template
 *
 * @package App\Twig
 */
class ConfigurationGlobalAccess
{
    private ConfigurationManager $manager;

    public function __construct(ConfigurationManager $manager)
    {
        $this->manager = $manager;
    }

    private function getAsArray(): array
    {
        $configuration = $this->manager->get();
        return ['theme' => $configuration->getTheme()];
    }

    public function __get(string $key)
    {
        $config = $this->getAsArray();

        if (array_key_exists($key, $config)) {
            return $config[$key];
        }

        return null;
    }

    public function __set(string $key, string $value)
    {
        $message = 'Cannot set values in templates. Tried to save "%s" for key "%s"';
        throw new RuntimeException(sprintf($message, $value, $key));
    }

    public function __isset(string $key)
    {
        $config = $this->getAsArray();
        return array_key_exists($key, $config);
    }
}
