<?php

declare(strict_types=1);

namespace App\Services\ConfigurationMapper;

use App\Services\ConfigurationMapper\Exceptions\UnknownServiceConfigurationException;
use App\Services\ConfigurationMapper\Interfaces\ServiceConfigurationMapperInterface;

class ServiceConfigurationMapper implements ServiceConfigurationMapperInterface
{
    /**
     * @var array|null
     */
    private ?array $config;

    public function __construct()
    {
        $this->config = null;
    }

    /**
     * @throws UnknownServiceConfigurationException
     */
    public function loadConfig(?string $config = null): void
    {
        if ($config === null) {
            throw new UnknownServiceConfigurationException();
        }

        $this->config = \config($config);
    }

    /**
     * @throws UnknownServiceConfigurationException
     */
    public function map(array $keyMapping): array
    {
        if ($this->config === null) {
            throw new UnknownServiceConfigurationException();
        }

        $resolved = [];
        foreach ($this->config as $key => $value) {
            $foundKey = array_search($key, $keyMapping, true);

            if ($foundKey !== false) {
                $resolved[$foundKey] = $value;
            }
        }

        return $resolved;
    }

    /**
     * @throws UnknownServiceConfigurationException
     * @param string $key
     * @return string|null
     */
    public function getByKey(string $key): ?string
    {
        if ($this->config === null) {
            throw new UnknownServiceConfigurationException();
        }

        $value = \array_search($key, \array_flip($this->config), true);

        if ($value === false) {
            return null;
        }

        return (string) $value;
    }
}
