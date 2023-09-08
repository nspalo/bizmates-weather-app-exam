<?php

declare(strict_types=1);

namespace App\Services\ConfigurationMapper\Interfaces;

interface ServiceConfigurationMapperInterface
{
    public function loadConfig(?string $config = null): void;
    public function map(array $keyMapping): array;
    public function getByKey(string $key): ?string;
}
