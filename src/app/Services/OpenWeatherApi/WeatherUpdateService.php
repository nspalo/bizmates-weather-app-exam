<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi;

use App\Enums\WeatherTypeEnum;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface;
use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WeatherUpdateService implements OpenWeatherApiServiceInterface
{
    private string $weatherApiKey;
    private string $weatherApiUnit;
    private string $weatherApiOutput;
    private string $weatherApiUri;
    private UrlQueryStringBuilderServiceInterface $urlQueryStringBuilderService;

    public function __construct(UrlQueryStringBuilderServiceInterface $urlQueryStringBuilderService)
    {
        $this->weatherApiKey = \config('services.api.open_weather.key');
        $this->weatherApiUnit = \config('services.api.open_weather.unit');
        $this->weatherApiOutput = \config('services.api.open_weather.max_output');
        $this->weatherApiUri = \config('services.api.open_weather.uri');

        $this->urlQueryStringBuilderService = $urlQueryStringBuilderService;
    }

    private function buildWeatherApiUrl(WeatherTypeEnum $requestType, float $lon, float $lat): string
    {
        $queryParam = [
            'lon' => $lon,
            'lat' => $lat,
            'units' => $this->weatherApiUnit,
            'appid' => $this->weatherApiKey,
        ];

        if ($requestType === WeatherTypeEnum::Forecast) {
            $queryParam['cnt'] = $this->weatherApiOutput;
        }

        $queryString = $this->urlQueryStringBuilderService->build($queryParam);

        return 'https://' . $this->weatherApiUri . '/' . $requestType->value . '?' . $queryString;
    }

    public function getWeatherForecast(float $lon, float $lat): Response
    {
        $forecastWeatherUrl = $this->buildWeatherApiUrl(WeatherTypeEnum::Forecast, $lon, $lat);

        return Http::get($forecastWeatherUrl);
    }

    public function getWeatherUpdate(float $lon, float $lat): Response
    {
        $currentWeatherUrl = $this->buildWeatherApiUrl(WeatherTypeEnum::Current, $lon, $lat);

        return Http::get($currentWeatherUrl);
    }
}
