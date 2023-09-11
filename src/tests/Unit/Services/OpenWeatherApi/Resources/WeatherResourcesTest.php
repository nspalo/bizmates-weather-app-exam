<?php

declare(strict_types=1);

namespace Unit\Services\OpenWeatherApi\Resources;

use App\Services\OpenWeatherApi\Resources\WeatherResources;
use Tests\TestCase;

class WeatherResourcesTest extends TestCase
{
    /**
     * @return void
     * @throws \JsonException
     */
    public function testResourceData(): void
    {
        $apiServiceTestResponse = file_get_contents(
            base_path('tests/Fixtures/ApiResponse/weather-forecast-response.json')
        );

        $data = json_decode($apiServiceTestResponse, true, 512, JSON_THROW_ON_ERROR);

        $expected = [
            [
                'country_code' => 'PH',
                'country_city' => 'Pateros',
                'timestamp' => 1694239200,
                'date' => 'September 09, 2023',
                'time' => '02:00PM',
                'month_day' => 'September 6',
                'day_of_week' => 'Saturday',
                'timezone' => 28800,
                'coordinate' => [
                    'lon' => 121.0764,
                    'lat' => 14.5605,
                ],
                'type' => 'Clouds',
                'description' => 'Broken clouds',
                'icon' => '04d',
                'temp' => 32.22,
                'temp_min' => 31.83,
                'temp_max' => 32.22,
                'feels_like' => 38.57,
                'humidity' => 63,
                'wind_speed' => 2.3760000000000003,
                'wind_direction' => 'SW',
                'sunrise' => '05:44AM',
                'sunset' => '06:02PM',
                'pressure' => 1010,
            ],
            [
                'country_code' => 'PH',
                'country_city' => 'Pateros',
                'timestamp' => 1694250000,
                'date' => 'September 09, 2023',
                'time' => '05:00PM',
                'month_day' => 'September 6',
                'day_of_week' => 'Saturday',
                'timezone' => 28800,
                'coordinate' => [
                    'lon' => 121.0764,
                    'lat' => 14.5605,
                ],
                'type' => 'Rain',
                'description' => 'Light rain',
                'icon' => '10d',
                'temp' => 30.62,
                'temp_min' => 29.72,
                'temp_max' => 30.62,
                'feels_like' => 37.45,
                'humidity' => 73,
                'wind_speed' => 14.328,
                'wind_direction' => 'SW',
                'sunrise' => '05:44AM',
                'sunset' => '06:02PM',
                'pressure' => 1008,
            ],
        ];

        $resource = new WeatherResources($data);

        self::assertEquals($expected, $resource->getResponse());
    }
}
