<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Resources;

use App\Http\Resources\Resource;
use App\Services\OpenWeatherApi\Interfaces\WeatherResourceInterface;

class WeatherResource extends Resource implements WeatherResourceInterface
{
    public function getResponse(): array
    {
        return [
            // Location Info
            'country_code' => $this->resource['sys']['country'],
            'country_city' => $this->resource['name'],
            'timestamp' => $this->resource['dt'],
            'timezone' => $this->resource['timezone'],
            'coordinate' => [
                'lon' => $this->resource['coord']['lon'],
                'lat' => $this->resource['coord']['lat'],
            ],

            // Current Weather Data
            'type' => $this->resource['weather'][0]['main'], // (Rain, Snow, Clouds etc.)
            'description' => $this->resource['weather'][0]['description'],
            'icon' => $this->resource['weather'][0]['icon'],

            // Main
            'temp' => $this->resource['main']['temp'],
            'temp_min' => $this->resource['main']['temp_min'],
            'temp_max' => $this->resource['main']['temp_max'],
            'feels_like' => $this->resource['main']['feels_like'],
            'humidity' => $this->resource['main']['humidity'],

            // Wind
            'wind_speed' => $this->resource['wind']['speed'],
            'wind_direction' => $this->resource['wind']['deg'],

            // sys
            'sunrise' => $this->resource['sys']['sunrise'],
            'sunset' => $this->resource['sys']['sunset'],
        ];
    }
}
