<?php declare(strict_types=1);

namespace App\Twig;

use RuntimeException;

/**
 * Allows to access specified variables from ENV file in templates
 *
 * @package App\Twig
 * @field   env
 * @field   version
 */
class EnvironmentVarsAccess
{
    private array $vars;

    public function __construct(string $env, string $version)
    {
        $this->vars = ['env' => $env, 'version' => $version];
    }

    public function __get(string $key)
    {
        if (array_key_exists($key, $this->vars)) {
            return $this->vars[$key];
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
        return array_key_exists($key, $this->vars);
    }
}
