<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi;

use App\Enums\WeatherTypeEnum;
use App\Services\ConfigurationMapper\Interfaces\ServiceConfigurationMapperInterface;
use App\Services\GeoapifyApi\Resources\GeolocationResource;
use App\Services\OpenWeatherApi\Interfaces\WeatherResourceInterface;
use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class AbstractOpenWeatherApiService
{
    private ServiceConfigurationMapperInterface $serviceConfigurationMapper;

    private UrlQueryStringBuilderServiceInterface $urlQueryStringBuilderService;

    public function __construct(
        ServiceConfigurationMapperInterface $serviceConfigurationMapper,
        UrlQueryStringBuilderServiceInterface $urlQueryStringBuilderService
    ) {
        $this->serviceConfigurationMapper = $serviceConfigurationMapper;
        $this->urlQueryStringBuilderService = $urlQueryStringBuilderService;

        $this->serviceConfigurationMapper->loadConfig('services.api.open_weather');
    }

    abstract public function getWeatherData(GeolocationResource $geolocation): WeatherResourceInterface;

    protected function buildOpenWeatherApiQueryString(GeolocationResource $geolocation, WeatherTypeEnum $weatherApiServiceType): string
    {
        $mapping = [
            'units' => 'unit',
            'lang' => 'lang',
            'appid' => 'key',
        ];

        if ($weatherApiServiceType === WeatherTypeEnum::Forecast) {
            $mapping['cnt'] = 'max_output';
        }

        $queryParam = $this->serviceConfigurationMapper->map($mapping);
        $queryParam = array_merge(
            $queryParam,
            [
                'lon' => $geolocation['lon'],
                'lat' => $geolocation['lat'],
            ]
        );

        return $this->urlQueryStringBuilderService->build($queryParam);
    }

    protected function sendRequest(GeolocationResource $geolocation, WeatherTypeEnum $apiServiceType): Response
    {
        $apiServiceUri = $this->serviceConfigurationMapper->getByKey('uri');
        $apiServiceQueryParam = $this->buildOpenWeatherApiQueryString($geolocation, $apiServiceType);

        $openWeatherApiServiceUrl = 'https://' . $apiServiceUri . '/' . $apiServiceType->value . '?' . $apiServiceQueryParam;

        return Http::get($openWeatherApiServiceUrl);
    }
}
