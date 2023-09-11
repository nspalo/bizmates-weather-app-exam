<?php

declare(strict_types=1);

namespace Unit\Services\GeoapifyApi\Resources;

use App\Services\GeoapifyApi\Resources\GeolocationResource;
use Tests\TestCase;

class GeolocationResourceTest extends TestCase
{
    /**
     * @return void
     * @throws \JsonException
     */
    public function testResourceData(): void
    {
        $apiServiceTestResponse = file_get_contents(
            base_path('tests/Fixtures/ApiResponse/geocoding-response.json')
        );

        $data = json_decode($apiServiceTestResponse, true, 512, JSON_THROW_ON_ERROR)['results'];

        $expected = [
            'city' => 'Tokyo',
            'country' => 'Japan',
            'country_code' => 'jp',
            'formatted' => 'Tokyo, Japan',
            'coordinate' => [
                'lon' => '139.7744912',
                'lat' => '35.6840574',
            ],
        ];

        $resource = new GeolocationResource($data);

        self::assertEquals($expected, $resource->getResponse());
        self::assertEquals(\array_keys($expected), \array_keys($resource->getResponse()));
    }
}
