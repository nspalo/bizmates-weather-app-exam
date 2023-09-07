<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Interfaces;

use App\Enums\WeatherTypeEnum;

interface OpenWeatherApiServiceFactoryInterface
{
    public function make(WeatherTypeEnum $weatherApiType): OpenWeatherApiServiceInterface;
}
