@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">


<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-sm-12 col-md-8 col-lg-10 col-xl-12">

        <div class="card" style="color: #4B515D; border-radius: 35px;">
            <div class="card-body p-4">


                <div class="d-flex">
                    <h2 class="flex-grow-1"><i class="bi bi-geo-alt"></i> {{ $geolocation['formatted'] }}</h2>
                    <h6>15:07</h6>
                </div>

                <form class="row g-3">
                <div class="d-flex input-group rounded mb-3">
                    <input id="inputAddress2" class="form-control rounded" type="search" placeholder="City" aria-label="Search" aria-describedby="search-input">
                    <button id="search-button" class="btn btn-outline-secondary rounded" type="button">Search</button>
                </div>
                </form>

                <div class="d-flex flex-column align-items-center text-center mt-5 mb-4">
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column text-center mt-5 mb-4">
                            <h6 class="display-4 mb-0 font-weight-bold" style="color: #1C2331;">{{ $weather['current']['temp'] }}°C</h6>
                            <span class="small" style="color: #868B94">Feels like {{ $weather['current']['feels_like'] }}°C</span>
                            <span class="small" style="color: #868B94">{{ $weather['current']['description'] }}</span>
                        </div>
                        <div class="d-flex flex-column text-center ml-5 mt-5 mb-4">
                            <img src="https://openweathermap.org/img/wn/{{ $weather['current']['icon'] }}@4x.png" alt="weather-icon">
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="flex-grow-1" style="font-size: 1rem;">
                        <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"> sunrise: <i class="bi bi-brightness-alt-high"></i> {{ $weather['current']['sunrise'] }}</span></div>
                        <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"> sunset: <i class="bi bi-brightness-alt-low"></i> {{ $weather['current']['sunset'] }}</span></div>
                        <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"> temp_max: <i class="bi bi-thermometer-high"></i> {{ $weather['current']['temp_max'] }}</span></div>
                        <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"> temp_min: <i class="bi bi-thermometer-low"></i> {{ $weather['current']['temp_min'] }}</span></div>
                        <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"> wind speed: <i class="bi bi-wind"></i> {{ $weather['current']['wind_speed'] }} km/h</span></div>
                        <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"> wind deg: <i class="bi bi-compass"></i> {{ $weather['current']['wind_direction'] }}</span></div>
                        <div><i class="fas fa-tint fa-fw" style="color: #868B94;"></i> <span class="ms-1"> humidity: <i class="bi bi-moisture"></i> {{ $weather['current']['humidity'] }}% </span></div>
                    </div>

                </div>

            </div>
        </div>



    </div>
</div>


        </div>
    </div>
</div>
@endsection
