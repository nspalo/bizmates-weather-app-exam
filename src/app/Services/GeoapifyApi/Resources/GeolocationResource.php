<?php

declare(strict_types=1);

namespace App\Services\GeoapifyApi\Resources;

use App\Http\Resources\Resource;

class GeolocationResource extends Resource
{
    public function __construct($resource)
    {
        $resource = $resource[0];

        parent::__construct($resource);
    }

    public function getResponse(): array
    {
        return [
            'city' => $this->resource['city'],
            'country' => $this->resource['country'],
            'country_code' => $this->resource['country_code'],
            'formatted' => $this->resource['formatted'],
            'coordinate' => [
                'lon' => $this->resource['lon'],
                'lat' => $this->resource['lat'],
            ],
        ];
    }
}
