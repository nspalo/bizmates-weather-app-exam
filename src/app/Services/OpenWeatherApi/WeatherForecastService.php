<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi;

use App\Enums\WeatherTypeEnum;
use App\Services\GeoapifyApi\Resources\GeolocationResource;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface;
use App\Services\OpenWeatherApi\Interfaces\WeatherResourceInterface;
use App\Services\OpenWeatherApi\Resources\WeatherResources;

class WeatherForecastService extends AbstractOpenWeatherApiService implements OpenWeatherApiServiceInterface
{
    /**
     * @param GeolocationResource $geolocation
     * @return WeatherResourceInterface
     */
    public function getWeatherData(GeolocationResource $geolocation): WeatherResourceInterface
    {
        $openWeatherApiResponse = $this->sendRequest($geolocation, WeatherTypeEnum::Forecast);

        return new WeatherResources($openWeatherApiResponse->json());
    }

    /**
     * @param WeatherTypeEnum $weatherApiType
     * @return bool
     */
    public function supports(WeatherTypeEnum $weatherApiType): bool
    {
        return $weatherApiType === WeatherTypeEnum::Forecast;
    }
}
