<?php

declare(strict_types=1);

namespace App\Services\GeoapifyApi;

use App\Services\ConfigurationMapper\Interfaces\ServiceConfigurationMapperInterface;
use App\Services\GeoapifyApi\Interfaces\GeoapifyApiServiceInterface;
use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;
use Illuminate\Support\Facades\Http;

class GeocodingService implements GeoapifyApiServiceInterface
{
    private UrlQueryStringBuilderServiceInterface $urlQueryStringBuilderService;
    private ServiceConfigurationMapperInterface $serviceConfigurationMapper;

    public function __construct(
        ServiceConfigurationMapperInterface $serviceConfigurationMapper,
        UrlQueryStringBuilderServiceInterface $urlQueryStringBuilderService
    ) {
        $this->serviceConfigurationMapper = $serviceConfigurationMapper;
        $this->urlQueryStringBuilderService = $urlQueryStringBuilderService;

        $this->serviceConfigurationMapper->loadConfig('services.api.geoapify');
    }

    private function buildGeoapifyApiUrl(string $location): string
    {
        $serviceApiUri = $this->serviceConfigurationMapper->getByKey('uri');
        $queryParam = $this->serviceConfigurationMapper->map([
            'type' => 'type',
            'limit' => 'max_output',
            'lang' => 'lang',
            'filter' => 'filter',
            'format' => 'format',
            'apiKey' => 'key',
        ]);

        $queryParam['text'] = $location;
        $queryString = $this->urlQueryStringBuilderService->build($queryParam);

        return 'https://' . $serviceApiUri  . '?' . $queryString;
    }

    public function getGeolocation(string $location): array
    {
        $geolocationUrl = $this->buildGeoapifyApiUrl($location);

        $responseGeolocation = Http::get($geolocationUrl);
        $data = $responseGeolocation->json('results');

        return [
            'city' => $data[0]['city'],
            'country' => $data[0]['country'],
            'country_code' => $data[0]['country_code'],
            'formatted' => $data[0]['formatted'],
            'lon' => $data[0]['lon'],
            'lat' => $data[0]['lat'],
        ];
    }
}
