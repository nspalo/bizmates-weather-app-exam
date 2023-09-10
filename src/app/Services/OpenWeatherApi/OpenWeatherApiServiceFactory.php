<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi;

use App\Enums\WeatherTypeEnum;
use App\Services\Collector\ServiceCollector;
use App\Services\OpenWeatherApi\Exceptions\UnknownOpenWeatherApiServiceException;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceFactoryInterface;
use App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface;

class OpenWeatherApiServiceFactory implements OpenWeatherApiServiceFactoryInterface
{
    /**
     * @var \App\Services\OpenWeatherApi\Interfaces\OpenWeatherApiServiceInterface[]
     */
    private $services;

    /**
     * @param iterable $services
     */
    public function __construct(iterable $services)
    {
        $this->services = ServiceCollector::filterByClass($services, OpenWeatherApiServiceInterface::class);
    }

    /**
     * @param WeatherTypeEnum $weatherApiType
     * @return OpenWeatherApiServiceInterface
     * @throws UnknownOpenWeatherApiServiceException
     */
    public function make(WeatherTypeEnum $weatherApiType): OpenWeatherApiServiceInterface
    {
        foreach ($this->services as $service) {
            if ($service->supports($weatherApiType) === true) {
                return $service;
            }
        }

        throw new UnknownOpenWeatherApiServiceException(
            \sprintf('Unknown Open Weather Api %s', $weatherApiType->value)
        );
    }
}
