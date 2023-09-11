<?php

declare(strict_types=1);

namespace Unit\Services\OpenWeatherApi\Resources;

use App\Services\OpenWeatherApi\Resources\WeatherResource;
use Tests\TestCase;

class WeatherResourceTest extends TestCase
{
    /**
     * @return void
     * @throws \JsonException
     */
    public function testResourceData(): void
    {
        $apiServiceTestResponse = \file_get_contents(
            \base_path('tests/Fixtures/ApiResponse/weather-update-response.json')
        );

        $data = \json_decode($apiServiceTestResponse, true, 512, JSON_THROW_ON_ERROR);

        $expected = [
            'country_code' => 'PH',
            'country_city' => 'Pateros',
            'timestamp' => 1694233973,
            'date' => 'September 09, 2023',
            'time' => '12:32PM',
            'month_day' => 'September 6',
            'day_of_week' => 'Saturday',
            'timezone' => 28800,
            'coordinate' => [
                'lon' => 121.0764,
                'lat' => 14.5605,
            ],
            'type' => 'Clouds',
            'description' => 'Few clouds',
            'icon' => '02d',
            'temp' => 32.51,
            'temp_min' => 30.56,
            'temp_max' => 32.86,
            'feels_like' => 39.51,
            'humidity' => 65,
            'wind_speed' => 6.444,
            'wind_direction' => 'E',
            'sunrise' => '05:44AM',
            'sunset' => '06:02PM',
            'pressure' => 1010,
        ];

        $resource = new WeatherResource($data);

        self::assertEquals($expected, $resource->getResponse());
    }
}
