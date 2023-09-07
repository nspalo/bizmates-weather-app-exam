<?php

namespace App\Providers;

use App\Services\GeoapifyApi\GeocodingService;
use App\Services\GeoapifyApi\Interfaces\GeoapifyApiServiceInterface;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface;
use App\Services\OpenWeatherApi\WeatherUpdateService;
use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;
use App\Services\UrlQueryStringBuilder\UrlQueryStringBuilderService;
use Illuminate\Support\ServiceProvider;

class WeatherAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UrlQueryStringBuilderServiceInterface::class, UrlQueryStringBuilderService::class);
        $this->app->bind(GeoapifyApiServiceInterface::class, GeocodingService::class);
        $this->app->bind(OpenWeatherApiServiceInterface::class, WeatherUpdateService::class);
    }
}
