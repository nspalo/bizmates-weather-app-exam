@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-sm-12 col-md-8 col-lg-10 col-xl-12">

        <!-- Current Weather -->
        <div class="card">

            <!-- Header: Weather Card -->
            <div class="card-header">
                <div class="d-flex">
                    <h2 class="flex-grow-1"><i class="bi bi-geo-alt"></i> {{ $geolocation['formatted'] }}</h2>
                    <h6>{{ $weather['date'] }} {{ $weather['time'] }}</h6>
                </div>

                <form class="row g-3">
                    <div class="d-flex input-group rounded mb-3">
                        <input id="inputAddress" class="form-control rounded" type="search" placeholder="City" aria-label="Search" aria-describedby="search-input">
                        <button id="searchButton" class="btn btn-outline-secondary rounded" type="button" onclick="sendMessage()">Search</button>
                    </div>
                </form>
            </div><!-- Header: Weather Card -->

            <!-- Body: Weather Card -->
            <div class="card-body">

                <div class="row g-0">

                    <div class="col-md-8">
                        <div class="d-flex flex-column align-items-center text-center mt-5 mb-4">

                            <h3 class="card-title border-bottom-1 fs-1">
                                {{ $weather['day_of_week'] }}, {{ $weather['date'] }} {{ $weather['time'] }}
                            </h3>

                            <div class="d-flex flex-row">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="https://openweathermap.org/img/wn/{{ $weather['icon'] }}@4x.png" width="300" alt="weather-icon">
                                </div>

                                <div class="d-flex flex-column text-center mt-5 mb-4">

                                    <h3 class="card-title border-bottom-1">{{ $weather['description'] }}</h3>
                                    <h1 class="display-4 mb-0 font-weight-bold" data-bs-toggle="tooltip" title="Temperature" style="color: #1C2331;">{{ $weather['temp'] }}°C</h1>
                                    <span class="small fs-4" style="color: #868B94">Feels like <i class="bi bi-thermometer-half"></i> {{ $weather['feels_like'] }}°C</span>

                                    <div class="d-flex flex-row fs-3">
                                        <div data-bs-toggle="tooltip" title="Highest Temperature">
                                            <span class="ms-1"><i class="bi bi-thermometer-low"></i> {{ $weather['temp_min'] }}</span>
                                        </div>
                                        <span>&nbsp;~&nbsp;</span>
                                        <div data-bs-toggle="tooltip" title="Lowest Temperature">
                                            <span class="ms-1"><i class="bi bi-thermometer-high"></i> {{ $weather['temp_max'] }}</span>
                                        </div>
                                        <span>°C</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="d-flex flex-column mt-5 mb-4">
                            <div class="flex-grow-1 fs-2">
                                <div data-bs-toggle="tooltip" title="Wind Speed"><span class="ms-1"><i class="bi bi-wind"></i> {{ $weather['wind_speed'] }} km/h</span></div>
                                <div data-bs-toggle="tooltip" title="Wind Direction"><span class="ms-1"><i class="bi bi-compass"></i> {{ $weather['wind_direction'] }}</span></div>
                                <div data-bs-toggle="tooltip" title="Humidity"><span class="ms-1"><i class="bi bi-moisture"></i> {{ $weather['humidity'] }}% </span></div>
                                <div data-bs-toggle="tooltip" title="Atmospheric pressure"><span class="ms-1"><i class="bi bi-speedometer2"></i> {{ $weather['pressure'] }}hPa </span></div>
                                <div data-bs-toggle="tooltip" title="Sunrise"><span class="ms-1"><i class="bi bi-brightness-alt-high"></i> {{ $weather['sunrise'] }}</span></div>
                                <div data-bs-toggle="tooltip" title="Sunset"><span class="ms-1"><i class="bi bi-brightness-alt-low"></i> {{ $weather['sunset'] }}</span></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div><!-- Body: Weather Card -->

            <!-- Footer: Weather Card -->
            <!-- TODO: DISABLED FOR NOW, NOT SURE WHAT TO PUT!!!
            <div class="card-footer text-end">
                <small class="text-muted ">-- footer --</small>
            </div>
            -->
            <!-- Footer: Weather Card -->

        </div><!-- Current Weather -->


        <!-- 5 Days Weather Forecast -->
        <div class="card-group">
            @foreach($weatherForecasts as $forecast)

                <!-- Weather Forecast -->
                <div class="card">
                    <!-- Header: Weather Card -->
                    <div class="d-flex flex-column text-center mt-1 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1" style="font-size: 1rem;">
                                <div>
                                    <img src="https://openweathermap.org/img/wn/{{ $forecast['icon'] }}@4x.png" alt="weather-icon">
                                </div>
                                <div>
                                    <h3><span class="ms-1">{{ $forecast['temp'] }}°C</span></h3>
                                </div>
                                <div class="small">
                                    <span class="ms-1">Feels like {{ $forecast['feels_like'] }}°C</span>
                                </div>
                            </div>
                        </div>
                    </div><!-- Header: Weather Card -->

                    <!-- Body: Weather Card -->
                    <div class="card-body text-center pt-2">
                        <h4 class="card-title border-bottom-1">{{ $forecast['description'] }}</h4>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1" style="font-size: 1rem;">
                                <div data-bs-toggle="tooltip" title="owest Temperature"><span class="ms-1"><i class="bi bi-thermometer-low"></i> {{ $forecast['temp_min'] }}</span></div>
                                <div data-bs-toggle="tooltip" title="Highest Temperature"><span class="ms-1"><i class="bi bi-thermometer-high"></i> {{ $forecast['temp_max'] }}</span></div>
                                <div data-bs-toggle="tooltip" title="Wind Speed"><span class="ms-1"><i class="bi bi-wind"></i> {{ $forecast['wind_speed'] }} km/h</span></div>
                                <div data-bs-toggle="tooltip" title="Wind Direction"><span class="ms-1"><i class="bi bi-compass"></i> {{ $forecast['wind_direction'] }}</span></div>
                                <div data-bs-toggle="tooltip" title="Humidity"><span class="ms-1"><i class="bi bi-moisture"></i> {{ $forecast['humidity'] }}% </span></div>
                                <div data-bs-toggle="tooltip" title="Atmospheric pressure"><span class="ms-1"><i class="bi bi-speedometer2"></i> {{ $forecast['pressure'] }}hPa </span></div>
                                <div data-bs-toggle="tooltip" title="Sunrise"><span class="ms-1"><i class="bi bi-brightness-alt-high"></i> {{ $forecast['sunrise'] }}</span></div>
                                <div data-bs-toggle="tooltip" title="Sunset"><span class="ms-1"><i class="bi bi-brightness-alt-low"></i> {{ $forecast['sunset'] }}</span></div>
                            </div>
                        </div>
                    </div><!-- Body: Weather Card -->

                    <!-- Footer: Weather Card -->
                    <div class="card-footer text-end">
                        <small class="text-muted ">{{ $forecast['date'] }} {{ $forecast['time'] }}</small>
                    </div><!-- Footer: Weather Card -->
                </div><!-- Weather Forecast -->

            @endforeach
        </div><!-- 5 Days Weather Forecast -->

    </div>
</div>


        </div>
    </div>
</div>
@endsection

@section('custom-js')
    @vite(['resources/js/weather-app.js'])
@endsection
