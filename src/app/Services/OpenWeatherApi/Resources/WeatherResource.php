<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Resources;

use App\Enums\Direction;
use App\Http\Resources\Resource;
use App\Services\OpenWeatherApi\Interfaces\WeatherResourceInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class WeatherResource extends Resource implements WeatherResourceInterface
{
    /**
     * @throws \Exception
     */
    public function getResponse(): array
    {
        $date = $this->getLocalDatetime($this->resource['dt'], $this->resource['timezone']);

        return [
            // Location Info
            'country_code' => $this->resource['sys']['country'],
            'country_city' => $this->resource['name'],
            'timestamp' => $this->resource['dt'],
            'date' => $date->isoFormat('MMMM DD, YYYY'),
            'time' => $date->isoFormat('hh:mmA'),
            'month_day' => $date->isoFormat('MMMM d'),
            'day_of_week' => $date->isoFormat('dddd'),
            'timezone' => $this->resource['timezone'],
            'coordinate' => [
                'lon' => $this->resource['coord']['lon'],
                'lat' => $this->resource['coord']['lat'],
            ],

            // Current Weather Data
            'type' => $this->resource['weather'][0]['main'], // (Rain, Snow, Clouds etc.)
            'description' => Str::ucfirst($this->resource['weather'][0]['description']),
            'icon' => $this->resource['weather'][0]['icon'],

            // Main
            'temp' => $this->resource['main']['temp'],
            'temp_min' => $this->resource['main']['temp_min'],
            'temp_max' => $this->resource['main']['temp_max'],
            'feels_like' => $this->resource['main']['feels_like'],
            'humidity' => $this->resource['main']['humidity'],
            'pressure' => $this->resource['main']['pressure'],

            // Wind
            'wind_speed' => ($this->resource['wind']['speed'] * 3.6),
            'wind_direction' => Direction::convertFromDegrees((int) $this->resource['wind']['deg']),

            // sys
            'sunrise' => $this->getLocalDatetime($this->resource['sys']['sunrise'], $this->resource['timezone'])
                ->isoFormat('hh:mmA'),
            'sunset' => $this->getLocalDatetime($this->resource['sys']['sunset'], $this->resource['timezone'])
                ->isoFormat('hh:mmA'),
        ];
    }

    /**
     * @throws \Exception
     */
    private function getLocalDatetime(int $unixTimestamp, int $timezoneInSeconds): Carbon
    {
        return Carbon::createFromTimestamp($unixTimestamp)
            ->setTimezone((string) $this->secondsToHour($timezoneInSeconds));
    }

    private function secondsToHour(int $seconds): int
    {
        return $seconds / 3600;
    }
}
