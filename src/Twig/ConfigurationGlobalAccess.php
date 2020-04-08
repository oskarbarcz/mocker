<?php declare(strict_types=1);

namespace App\Twig;

use App\Entity\Configuration;
use App\Service\ConfigurationManager;

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

    /**
     * Returns the configuration object
     *
     * @return Configuration
     */
    public function get(): Configuration
    {
        return $this->manager->get();
    }


}
