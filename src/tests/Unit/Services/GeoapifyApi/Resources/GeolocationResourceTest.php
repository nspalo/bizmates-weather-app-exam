<?php

declare(strict_types=1);

namespace Unit\Services\GeoapifyApi\Resources;

use App\Services\GeoapifyApi\Resources\GeolocationResource;
use PHPUnit\Framework\TestCase;

class GeolocationResourceTest extends TestCase
{
    /**
     * @return iterable
     */
    public function getTestData(): iterable
    {
        yield [
            [
                'city' => 'City Name',
                'country' => 'Country Name',
                'country_code' => 'ABC',
                'formatted' => 'City Name, Country Name',
                'lon' => '0123.4',
                'lat' => '5678.9',
            ],
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
            'city' => 'City Name',
            'country' => 'Country Name',
            'country_code' => 'ABC',
            'formatted' => 'City Name, Country Name',
            'coordinate' => [
                'lon' => '0123.4',
                'lat' => '5678.9',
            ]
        ];

        $resource = new GeolocationResource([$data]);

        self::assertEquals($expected, $resource->getResponse());
        self::assertEquals(\array_keys($expected), \array_keys($resource->getResponse()));
    }
}
