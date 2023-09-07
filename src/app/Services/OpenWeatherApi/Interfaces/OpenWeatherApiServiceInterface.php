<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Interfaces;

use App\Enums\WeatherTypeEnum;
use Illuminate\Http\Client\Response;

interface OpenWeatherApiServiceInterface
{
    public function getWeatherForecast(float $lon, float $lat): Response;

    public function getWeatherUpdate(float $lon, float $lat): Response;
}
