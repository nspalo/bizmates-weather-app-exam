<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Resources;

use App\Http\Resources\Resource;
use App\Services\OpenWeatherApi\Interfaces\WeatherResourceInterface;

class WeatherResources extends Resource implements WeatherResourceInterface
{
    /**
     * @return array
     */
    public function getResponse(): array
    {
        $weatherForecast = $this->resource['list'];

        $forecast = [];
        foreach ($weatherForecast as $weather) {
            $weatherData = new WeatherResource([
                'coord' => $this->resource['city']['coord'],
                'weather' => $weather['weather'],
                'main' => $weather['main'],
                'wind' => $weather['wind'],
                'dt' => $weather['dt'],
                'sys' => [
                    'country' => $this->resource['city']['country'],
                    'sunrise' => $this->resource['city']['sunrise'],
                    'sunset' => $this->resource['city']['sunset'],
                ],
                'timezone' => $this->resource['city']['timezone'],
                'name' => $this->resource['city']['name'],
            ]);

            $forecast[] = $weatherData->getResponse();
        }

        return $forecast;
    }
}
