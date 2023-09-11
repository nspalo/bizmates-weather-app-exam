<?php

declare(strict_types=1);

namespace Unit\Services\GeoapifyApi;

use App\Services\ConfigurationMapper\Interfaces\ServiceConfigurationMapperInterface;
use App\Services\GeoapifyApi\GeocodingService;
use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GeocodingServiceTest extends TestCase
{
    /**
     * @return void
     * @throws RequestException
     */
    public function testService(): void
    {
        $apiServiceEndpoint = 'https://api.geoapify.com/v1/geocode/search?filter=*';
        $apiServiceTestResponse = file_get_contents(
            base_path('tests/Fixtures/ApiResponse/geocoding-response.json')
        );

        Http::fake([
            $apiServiceEndpoint => Http::response($apiServiceTestResponse, 200),
        ]);

        $expected = [
            'city' => 'Tokyo',
            'country' => 'Japan',
            'country_code' => 'jp',
            'formatted' => 'Tokyo, Japan',
            'coordinate' => [
                'lon' => 139.7744912,
                'lat' => 35.6840574,
            ],
        ];

        $configMapper = $this->app->make(ServiceConfigurationMapperInterface::class);
        $urlBuilder = $this->app->make(UrlQueryStringBuilderServiceInterface::class);

        $service = new GeocodingService($configMapper, $urlBuilder);
        $actual = $service->getGeolocation('location');

        self::assertSame($expected, $actual->getResponse());
    }
}
