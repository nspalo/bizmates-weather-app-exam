<?php

declare(strict_types=1);

namespace Unit\Services\ConfigurationMapper;

use App\Services\ConfigurationMapper\Exceptions\UnknownServiceConfigurationException;
use App\Services\ConfigurationMapper\ServiceConfigurationMapper;
use Tests\TestCase;

class ServiceConfigurationMapperTest extends TestCase
{
    /**
     * @return void
     * @throws UnknownServiceConfigurationException
     */
    public function testLoadConfigShouldThrowException(): void
    {
        $this->expectException(UnknownServiceConfigurationException::class);

        $service = new ServiceConfigurationMapper();
        $service->loadConfig();
    }

    /**
     * @return void
     * @throws UnknownServiceConfigurationException
     */
    public function testMapShouldThrowException(): void
    {
        $this->expectException(UnknownServiceConfigurationException::class);

        $service = new ServiceConfigurationMapper();
        $service->map([]);
    }

    /**
     * @return void
     * @throws UnknownServiceConfigurationException
     */
    public function testGetByKeyShouldThrowException(): void
    {
        $this->expectException(UnknownServiceConfigurationException::class);

        $service = new ServiceConfigurationMapper();
        $service->getByKey('key-here');
    }

    /**
     * @return void
     * @throws UnknownServiceConfigurationException
     */
    public function testSuccess(): void
    {
        $expected = 'metric';
        $service = new ServiceConfigurationMapper();
        $service->loadConfig('services.api.open_weather');
        $actual = $service->getByKey('unit');

        self::assertSame($expected, $actual);
    }
}
