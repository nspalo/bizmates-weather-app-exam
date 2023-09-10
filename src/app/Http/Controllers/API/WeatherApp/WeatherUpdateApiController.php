<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\WeatherApp;

use App\Enums\WeatherTypeEnum;
use App\Http\Controllers\Controller;
use App\Services\GeoapifyApi\Interfaces\GeoapifyApiServiceInterface;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceFactoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherUpdateApiController extends Controller
{
    protected GeoapifyApiServiceInterface $geoapifyGeocodingService;

    protected OpenWeatherApiServiceFactoryInterface $weatherApiServiceFactory;

    public function __construct(
        GeoapifyApiServiceInterface $geoapifyGeocodingService,
        OpenWeatherApiServiceFactoryInterface $weatherApiServiceFactory
    ) {
        $this->geoapifyGeocodingService = $geoapifyGeocodingService;
        $this->weatherApiServiceFactory = $weatherApiServiceFactory;
    }

    public function __invoke(Request $request): JsonResource
    {
        $location = $request->get('location') ?? \config('services.api.geoapify.default_search');

        $responseGeolocation = $this->geoapifyGeocodingService->getGeolocation($location);

        $responseCurrentWeather = $this->weatherApiServiceFactory->make(WeatherTypeEnum::Current)
            ->getWeatherData($responseGeolocation);

        $responseForecastWeather = $this->weatherApiServiceFactory->make(WeatherTypeEnum::Forecast)
            ->getWeatherData($responseGeolocation);

        $data = [
            'geolocation' => $responseGeolocation->getResponse(),
            'weather' => $responseCurrentWeather->getResponse(),
            'weatherForecasts' => $responseForecastWeather->getResponse(),
        ];

        return new JsonResource($data);
    }
}
