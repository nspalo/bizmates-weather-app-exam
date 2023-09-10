<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Interfaces;

interface WeatherResourceInterface
{
    public function getResponse(): array;
}
