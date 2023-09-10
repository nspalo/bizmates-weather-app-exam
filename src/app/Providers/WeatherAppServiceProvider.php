<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ConfigurationMapper\Interfaces\ServiceConfigurationMapperInterface;
use App\Services\ConfigurationMapper\ServiceConfigurationMapper;
use App\Services\GeoapifyApi\GeocodingService;
use App\Services\GeoapifyApi\Interfaces\GeoapifyApiServiceInterface;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceFactoryInterface;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface;
use App\Services\OpenWeatherApi\OpenWeatherApiServiceFactory;
use App\Services\OpenWeatherApi\WeatherForecastService;
use App\Services\OpenWeatherApi\WeatherUpdateService;
use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;
use App\Services\UrlQueryStringBuilder\UrlQueryStringBuilderService;
use Illuminate\Contracts\Foundation\Application;
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
        $this->app->bind(ServiceConfigurationMapperInterface::class, ServiceConfigurationMapper::class);
        $this->app->bind(UrlQueryStringBuilderServiceInterface::class, UrlQueryStringBuilderService::class);
        $this->app->bind(GeoapifyApiServiceInterface::class, GeocodingService::class);

        $this->app->singleton(
            OpenWeatherApiServiceFactoryInterface::class,
            static function (Application $app): OpenWeatherApiServiceFactory {
                $app->tag([
                    WeatherUpdateService::class,
                    WeatherForecastService::class,
                ], [OpenWeatherApiServiceInterface::class]);

                return new OpenWeatherApiServiceFactory($app->tagged(OpenWeatherApiServiceInterface::class));
            }
        );
    }
}
