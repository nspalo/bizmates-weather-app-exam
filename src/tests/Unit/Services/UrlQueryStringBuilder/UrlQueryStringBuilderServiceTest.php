<?php

declare(strict_types=1);

namespace Unit\Services\UrlQueryStringBuilder;

use App\Services\UrlQueryStringBuilder\UrlQueryStringBuilderService;
use Tests\TestCase;

class UrlQueryStringBuilderServiceTest extends TestCase
{
    public function testBuild(): void
    {
        $expected = 'lon=121.0764343&lat=14.5605166&units=Metric&appid=3081d1865a4963e661c7c5a427bce266';

        $service = new UrlQueryStringBuilderService();
        $actual = $service->build([
            'lon' => '121.0764343',
            'lat' => '14.5605166',
            'units' => 'Metric',
            'appid' => '3081d1865a4963e661c7c5a427bce266',
        ]);

        self::assertEquals($expected, $actual);
    }

    public function testBuildEmptyParam(): void
    {
        $expected = '';

        $service = new UrlQueryStringBuilderService();
        $actual = $service->build([]);

        self::assertEquals($expected, $actual);
    }
}
