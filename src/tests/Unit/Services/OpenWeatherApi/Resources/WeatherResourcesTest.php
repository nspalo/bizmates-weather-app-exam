<?php

declare(strict_types=1);

namespace Unit\Services\OpenWeatherApi\Resources;

use App\Services\OpenWeatherApi\Resources\WeatherResources;
use PHPUnit\Framework\TestCase;

class WeatherResourcesTest extends TestCase
{
    /**
     * @return iterable
     * @throws \JsonException
     */
    public function getTestData(): iterable
    {
        yield [
            json_decode('{
                "cod": "200",
                "message": 0,
                "cnt": 5,
                "list":
                [
                    {
                        "dt": 1694239200,
                        "main": {
                            "temp": 32.22,
                            "feels_like": 38.57,
                            "temp_min": 31.83,
                            "temp_max": 32.22,
                            "pressure": 1010,
                            "sea_level": 1010,
                            "grnd_level": 1006,
                            "humidity": 63,
                            "temp_kf": 0.39
                        },
                        "weather": [
                            {
                                "id": 803,
                                "main": "Clouds",
                                "description": "broken clouds",
                                "icon": "04d"
                            }
                        ],
                        "clouds": {
                            "all": 58
                        },
                        "wind": {
                            "speed": 0.66,
                            "deg": 255,
                            "gust": 1.53
                        },
                        "visibility": 10000,
                        "pop": 0.13,
                        "sys": {
                            "pod": "d"
                        },
                        "dt_txt": "2023-09-09 06:00:00"
                    },
                    {
                        "dt": 1694250000,
                        "main": {
                            "temp": 30.62,
                            "feels_like": 37.45,
                            "temp_min": 29.72,
                            "temp_max": 30.62,
                            "pressure": 1008,
                            "sea_level": 1008,
                            "grnd_level": 1006,
                            "humidity": 73,
                            "temp_kf": 0.9
                        },
                        "weather": [
                            {
                                "id": 500,
                                "main": "Rain",
                                "description": "light rain",
                                "icon": "10d"
                            }
                        ],
                        "clouds": {
                            "all": 55
                        },
                        "wind": {
                            "speed": 3.98,
                            "deg": 252,
                            "gust": 4.55
                        },
                        "visibility": 10000,
                        "pop": 0.42,
                        "rain": {
                            "3h": 0.68
                        },
                        "sys": {
                            "pod": "d"
                        },
                        "dt_txt": "2023-09-09 09:00:00"
                    }
                ],
                "city": {
                    "id": 1694403,
                    "name": "Pateros",
                    "coord": {
                        "lat": 14.5605,
                        "lon": 121.0764
                    },
                    "country": "PH",
                    "population": 1000,
                    "timezone": 28800,
                    "sunrise": 1694209454,
                    "sunset": 1694253764
                    }
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
                    'lat' => 14.5605
                ],
                'type' => 'Clouds',
                'description' => 'Broken clouds',
                'icon' => '04d',
                'temp' => 32.22,
                'temp_min' => 31.83,
                'temp_max' => 32.22,
                'feels_like' => 38.57,
                'humidity' => 63,
                'wind_speed' =>  2.3760000000000003,
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
                    'lat' => 14.5605
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
            ]
        ];

        $resource = new WeatherResources($data);

        self::assertEquals($expected, $resource->getResponse());
    }
}
