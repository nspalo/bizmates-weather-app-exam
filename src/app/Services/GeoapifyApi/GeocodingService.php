<?php

declare(strict_types=1);

namespace App\Services\GeoapifyApi;

use App\Services\GeoapifyApi\Interfaces\GeoapifyApiServiceInterface;
use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;
use Illuminate\Support\Facades\Http;

class GeocodingService implements GeoapifyApiServiceInterface
{
    private string $geoapifyApiKey;
    private string $geoapifyApiUri;
    private string $geoapifyApiFilter;
    private string $geoapifyApiFormat;
    private string $geoapifyApiLang;
    private string $geoapifyApiMaxOutput;
    private string $geoapifyApiType;
    private UrlQueryStringBuilderServiceInterface $urlQueryStringBuilderService;

    public function __construct(UrlQueryStringBuilderServiceInterface $urlQueryStringBuilderService)
    {
        $this->geoapifyApiKey = \config('services.api.geoapify.key');
        $this->geoapifyApiUri = \config('services.api.geoapify.uri');
        $this->geoapifyApiFilter = \config('services.api.geoapify.filter');
        $this->geoapifyApiFormat = \config('services.api.geoapify.format');
        $this->geoapifyApiLang = \config('services.api.geoapify.lang');
        $this->geoapifyApiMaxOutput = \config('services.api.geoapify.max_output');
        $this->geoapifyApiType = \config('services.api.geoapify.type');

        $this->urlQueryStringBuilderService = $urlQueryStringBuilderService;
    }

    private function buildGeoapifyApiUrl(string $location): string
    {
        $queryParam = [
            'text' => $location,
            'type' => $this->geoapifyApiType,
            'limit' => $this->geoapifyApiMaxOutput,
            'lang' => $this->geoapifyApiLang,
            'filter' => $this->geoapifyApiFilter,
            'format' => $this->geoapifyApiFormat,
            'apiKey' => $this->geoapifyApiKey,
        ];

        $queryString = $this->urlQueryStringBuilderService->build($queryParam);

        return 'https://' . $this->geoapifyApiUri  . '?' . $queryString;
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
