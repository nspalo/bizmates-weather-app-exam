<?php

declare(strict_types=1);

namespace App\Services\GeoapifyApi\Interfaces;

interface GeoapifyApiServiceInterface
{
    public function getGeolocation(string $location): array;
}
