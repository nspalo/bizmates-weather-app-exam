<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi;

use App\Enums\WeatherTypeEnum;
use App\Services\GeoapifyApi\Resources\GeolocationResource;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface;
use App\Services\OpenWeatherApi\Interfaces\WeatherResourceInterface;
use App\Services\OpenWeatherApi\Resources\WeatherResource;

class WeatherUpdateService extends AbstractOpenWeatherApiService implements OpenWeatherApiServiceInterface
{
    public function getWeatherData(GeolocationResource $geolocation): WeatherResourceInterface
    {
        $openWeatherApiResponse = $this->sendRequest($geolocation, WeatherTypeEnum::Current);

        return new WeatherResource($openWeatherApiResponse->json());
    }

    public function supports(WeatherTypeEnum $weatherApiType): bool
    {
        return $weatherApiType === WeatherTypeEnum::Current;
    }
}
