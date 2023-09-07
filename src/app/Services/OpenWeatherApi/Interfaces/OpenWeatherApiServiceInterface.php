<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Interfaces;

use App\Enums\WeatherTypeEnum;
use Illuminate\Http\Client\Response;

interface OpenWeatherApiServiceInterface
{
    public function supports(WeatherTypeEnum $weatherApiType): bool;
    public function getWeatherData(float $lon, float $lat): Response;
}
