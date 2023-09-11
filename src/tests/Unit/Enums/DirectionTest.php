<?php

declare(strict_types=1);

namespace Unit\Enums;

use App\Enums\Direction;
use Tests\TestCase;

class DirectionTest extends TestCase
{
    /**
     * @return mixed[]
     */
    public function getDegreesTestData(): iterable
    {
        // Test Cardinal Directions
        yield 'North 0' => [
            'degrees' => '0',
            'expected' => 'N',
        ];
        yield 'North 360' => [
            'degrees' => '360',
            'expected' => 'N',
        ];
        yield 'East' => [
            'degrees' => '90',
            'expected' => 'E',
        ];
        yield 'South' => [
            'degrees' => '180',
            'expected' => 'S',
        ];
        yield 'West' => [
            'degrees' => '270',
            'expected' => 'W',
        ];

        // Test Ordinal Directions
        yield 'North East' => [
            'degrees' => '45',
            'expected' => 'NE',
        ];
        yield 'South East' => [
            'degrees' => '135',
            'expected' => 'SE',
        ];
        yield 'South West' => [
            'degrees' => '225',
            'expected' => 'SW',
        ];
        yield 'North West' => [
            'degrees' => '315',
            'expected' => 'NW',
        ];

        // Test for Anything unexpected!
        yield 'North 10' => [
            'degrees' => '10',
            'expected' => 'N',
        ];
        yield 'South West 269' => [
            'degrees' => '269',
            'expected' => 'SW',
        ];
        yield 'South East 154' => [
            'degrees' => '145',
            'expected' => 'SE',
        ];
        yield 'South 900' => [
            'degrees' => '900',
            'expected' => 'S',
        ];
        yield 'West 271.5' => [
            'degrees' => '271.5',
            'expected' => 'W',
        ];
        yield 'West -271.5' => [
            'degrees' => '-271.5',
            'expected' => 'W',
        ];
    }

    /**
     * @dataProvider getDegreesTestData
     */
    public function testDirection(string $degrees, string $expected): void
    {
        $direction = Direction::convertFromDegrees((int) $degrees);

        $this->assertEquals($expected, $direction);
    }
}
