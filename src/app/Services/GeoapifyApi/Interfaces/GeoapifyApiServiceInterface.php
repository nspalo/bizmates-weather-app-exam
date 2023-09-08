<?php

declare(strict_types=1);

namespace App\Services\GeoapifyApi\Interfaces;

use App\Services\GeoapifyApi\Resources\GeolocationResource;

interface GeoapifyApiServiceInterface
{
    public function getGeolocation(string $location): GeolocationResource;
}
