<?php

declare(strict_types=1);

namespace App\Services\ConfigurationMapper\Interfaces;

interface ServiceConfigurationMapperInterface
{
    /**
     * @param string|null $config
     * @return void
     */
    public function loadConfig(?string $config = null): void;

    /**
     * @param array $keyMapping
     * @return array
     */
    public function map(array $keyMapping): array;

    /**
     * @param string $key
     * @return string|null
     */
    public function getByKey(string $key): ?string;
}
