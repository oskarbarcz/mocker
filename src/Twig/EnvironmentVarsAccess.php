<?php declare(strict_types=1);

namespace App\Twig;

/**
 * Allows to access specified variables from ENV file in templates
 *
 * @package App\Twig
 */
class EnvironmentVarsAccess
{
    private array $vars;

    public function __construct(string $env, string $version)
    {
        $this->vars = ['env' => $env, 'version' => $version];
    }

    /**
     * Returns the available variables
     *
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->vars;
    }

}
