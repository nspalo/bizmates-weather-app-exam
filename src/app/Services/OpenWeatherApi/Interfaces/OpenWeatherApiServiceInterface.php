<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Interfaces;

use App\Enums\WeatherTypeEnum;
use App\Services\GeoapifyApi\Resources\GeolocationResource;

interface OpenWeatherApiServiceInterface
{
    public function supports(WeatherTypeEnum $weatherApiType): bool;

    public function getWeatherData(GeolocationResource $geolocation): WeatherResourceInterface;
}
