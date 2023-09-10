<?php

declare(strict_types=1);

namespace Unit\Services\OpenWeatherApi\Resources;

use App\Services\OpenWeatherApi\Resources\WeatherResource;
use PHPUnit\Framework\TestCase;

class WeatherResourceTest extends TestCase
{
    /**
     * @return iterable
     * @throws \JsonException
     */
    public function getTestData(): iterable
    {
        yield [
            json_decode('{
                "coord": {
                    "lon": 121.0764,
                    "lat": 14.5605
                },
                "weather": [
                    {
                        "id": 801,
                        "main": "Clouds",
                        "description": "few clouds",
                        "icon": "02d"
                    }
                ],
                "base": "stations",
                "main": {
                    "temp": 32.51,
                    "feels_like": 39.51,
                    "temp_min": 30.56,
                    "temp_max": 32.86,
                    "pressure": 1010,
                    "humidity": 65
                },
                "visibility": 9000,
                "wind": {
                    "speed": 1.79,
                    "deg": 90,
                    "gust": 1.79
                },
                "clouds": {
                    "all": 20
                },
                "dt": 1694233973,
                "sys": {
                    "type": 2,
                    "id": 2083945,
                    "country": "PH",
                    "sunrise": 1694209454,
                    "sunset": 1694253764
                },
                "timezone": 28800,
                "id": 1694403,
                "name": "Pateros",
                "cod": 200
                }',
                true,
                512,
                JSON_THROW_ON_ERROR
            )
        ];
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider getTestData
     */
    public function testResourceData(array $data): void
    {
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
                'lat' => 14.5605
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
