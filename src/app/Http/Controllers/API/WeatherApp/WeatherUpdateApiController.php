<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\WeatherApp;

use App\Http\Controllers\Controller;
use App\Services\GeoapifyApi\Interfaces\GeoapifyApiServiceInterface;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherUpdateApiController extends Controller
{
    protected GeoapifyApiServiceInterface $geoapifyGeocodingService;
    protected OpenWeatherApiServiceInterface $weatherApiService;

    public function __construct(
        GeoapifyApiServiceInterface $geoapifyGeocodingService,
        OpenWeatherApiServiceInterface $weatherApiService
    ) {
        $this->geoapifyGeocodingService = $geoapifyGeocodingService;
        $this->weatherApiService = $weatherApiService;
    }

    public function __invoke(Request $request): JsonResource
    {
        $location = $request->get('location') ?? \config('services.api.geoapify.default_search');

        $responseGeolocation = $this->geoapifyGeocodingService->getGeolocation($location);

        $responseCurrentWeather =  $this->weatherApiService->getWeatherUpdate($responseGeolocation['lon'], $responseGeolocation['lat']);
        $responseForecastWeather =  $this->weatherApiService->getWeatherForecast($responseGeolocation['lon'], $responseGeolocation['lat']);

        return new JsonResource([
            'weather' => [
                'geolocation' => $responseGeolocation,
                'current' => $responseCurrentWeather->json(),
                'forecast' => $responseForecastWeather->json(),
            ],
        ]);
    }
}
