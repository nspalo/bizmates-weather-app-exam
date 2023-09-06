<?php

declare(strict_types=1);

namespace App\Http\Controllers\WeatherApp;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class WeatherUpdateController extends Controller
{
    public function index(): View
    {
        return view('weather-update');
    }
}
