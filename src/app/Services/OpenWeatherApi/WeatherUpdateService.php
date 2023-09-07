<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi;

use App\Enums\WeatherTypeEnum;
use App\Services\ConfigurationMapper\Interfaces\ServiceConfigurationMapperInterface;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface;
use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WeatherUpdateService implements OpenWeatherApiServiceInterface
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

    public function getWeatherData(float $lon, float $lat): Response
    {
        $serviceApiUri = $this->serviceConfigurationMapper->getByKey('uri');
        $queryParam = $this->serviceConfigurationMapper->map([
            'units' => 'unit',
            'lang' => 'lang',
            'appid' => 'key',
        ]);

        $queryParam = array_merge(
            $queryParam, [
                'lon' => $lon,
                'lat' => $lat,
            ]
        );

        $queryString = $this->urlQueryStringBuilderService->build($queryParam);

        $currentWeatherUrl = 'https://' . $serviceApiUri . '/' . WeatherTypeEnum::Current->value . '?' . $queryString;

        return Http::get($currentWeatherUrl);
    }

    public function supports(WeatherTypeEnum $weatherApiType): bool
    {
        return $weatherApiType === WeatherTypeEnum::Current;
    }
}
