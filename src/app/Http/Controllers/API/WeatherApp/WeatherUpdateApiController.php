<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\WeatherApp;

use App\Enums\WeatherTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class WeatherUpdateApiController extends Controller
{
    private string $weatherApiKey;
    private string $weatherApiUnit;
    private string $weatherApiOutput;
    private string $weatherApiUri;
    private string $geoapifyApiKey;
    private string $geoapifyApiUri;
    private string $geoapifyApiFilter;
    private string $geoapifyApiFormat;
    private string $geoapifyApiLang;
    private string $geoapifyApiMaxOutput;
    private string $geoapifyApiType;

    public function __construct()
    {
        $this->weatherApiKey = \config('services.api.open_weather.key');
        $this->weatherApiUnit = \config('services.api.open_weather.unit');
        $this->weatherApiOutput = \config('services.api.open_weather.max_output');
        $this->weatherApiUri = \config('services.api.open_weather.uri');
        $this->geoapifyApiKey = \config('services.api.geoapify.key');
        $this->geoapifyApiUri = \config('services.api.geoapify.uri');
        $this->geoapifyApiFilter = \config('services.api.geoapify.filter');
        $this->geoapifyApiFormat = \config('services.api.geoapify.format');
        $this->geoapifyApiLang = \config('services.api.geoapify.lang');
        $this->geoapifyApiMaxOutput = \config('services.api.geoapify.max_output');
        $this->geoapifyApiType = \config('services.api.geoapify.type');
    }

    public function __invoke(Request $request): JsonResource
    {
        $location = $request->get('location') ?? \config('services.api.geoapify.default_search');

        $responseGeolocation = $this->getGeoapifyGeolocation($location);

        $responseCurrentWeather =  $this->getWeatherUpdate($responseGeolocation['lon'], $responseGeolocation['lat']);
        $responseForecastWeather =  $this->getWeatherForecast($responseGeolocation['lon'], $responseGeolocation['lat']);

        return new JsonResource([
            'weather' => [
                'geolocation' => $responseGeolocation,
                'current' => $responseCurrentWeather->json(),
                'forecast' => $responseForecastWeather->json(),
            ],
        ]);
    }

    private function buildQueryString(array $queryParam): string
    {
        return implode(
            '&',
            array_map(
                static function($key, $value){
                    return $key . '=' . $value;
                },
                array_keys($queryParam),
                $queryParam
            )
        );
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

        $queryString = $this->buildQueryString($queryParam);

        return 'https://' . $this->geoapifyApiUri  . '?' . $queryString;
    }

    private function getGeoapifyGeolocation(string $location): array
    {
        $geolocationUrl = $this->buildGeoapifyApiUrl($location);
        $responseGeolocation = Http::get($geolocationUrl);
        $data = $responseGeolocation->json('results');

        return [
            'country' => $data[0]['country'],
            'country_code' => $data[0]['country_code'],
            'city' => $data[0]['city'],
            'formatted' => $data[0]['formatted'],
            'lon' => $data[0]['lon'],
            'lat' => $data[0]['lat'],
        ];
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

        $queryString = $this->buildQueryString($queryParam);

        return 'https://' . $this->weatherApiUri . '/' . $requestType->value . '?' . $queryString;
    }

    private function getWeatherUpdate(float $lon, float $lat): Response
    {
        $currentWeatherUrl = $this->buildWeatherApiUrl(WeatherTypeEnum::Current, $lon, $lat);

        return Http::get($currentWeatherUrl);
    }

    private function getWeatherForecast(float $lon, float $lat): Response
    {
        $forecastWeatherUrl = $this->buildWeatherApiUrl(WeatherTypeEnum::Forecast, $lon, $lat);

        return Http::get($forecastWeatherUrl);
    }
}
