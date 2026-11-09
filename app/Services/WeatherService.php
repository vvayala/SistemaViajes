<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeather(
        float $latitude,
        float $longitude
    )
    {
        $cacheKey =
            'weather_' .
            md5(
                $latitude .
                '_' .
                $longitude
            );

        return Cache::remember(
            $cacheKey,
            now()->addHours(1),
            function () use (
                $latitude,
                $longitude
            ) {

                return Http::get(
                    'https://api.open-meteo.com/v1/forecast',
                    [
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'current' => 'temperature_2m,weather_code',
                    ]
                )->json();

            }
        );
    }
}