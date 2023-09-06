<?php

declare(strict_types=1);

namespace App\Enums;

enum WeatherTypeEnum: string
{
    case Current = 'weather';
    case Forecast = 'forecast';
}
