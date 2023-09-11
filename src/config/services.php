<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'api' => [
        'open_weather' => [
            'key' => env('OPEN_WEATHER_API_KEY', ''),
            'max_output' => env('OPEN_WEATHER_MAX_OUTPUT', '5'),
            'unit' => env('OPEN_WEATHER_UNIT', 'metric'),
            'lang' => env('OPEN_WEATHER_LANG', 'en'),
            'uri' => env('OPEN_WEATHER_API_URI', 'api.openweathermap.org/data/2.5'),
        ],
        'geoapify' => [
            'filter' => env('GEOAPIFY_FILTER', 'countrycode:jp'),
            'format' => env('GEOAPIFY_FORMAT', 'json'),
            'key' => env('GEOAPIFY_API_KEY', ''),
            'lang' => env('GEOAPIFY_LANG', 'en'),
            'max_output' => env('GEOAPIFY_MAX_OUTPUT', '1'),
            'type' => env('GEOAPIFY_TYPE', 'city'),
            'uri' => env('GEOAPIFY_API_URI', 'api.geoapify.com/v1/geocode/search'),
            'default_search' => env('GEOAPIFY_DEFAULT', 'Tokyo, Japan'),
        ],
    ],
];
