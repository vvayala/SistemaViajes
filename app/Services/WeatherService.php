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

        $cached = Cache::get($cacheKey);

        if ($cached) {
            return $cached;
        }

        $response = Http::timeout(30)->get(
            'https://api.open-meteo.com/v1/forecast',
            [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'current' => 'temperature_2m,weather_code',
            ]
        );

        if (!$response->successful()) {
            return null;
        }

        $weather = $response->json();

        if (
            !isset($weather['current'])
            ||
            !isset($weather['current']['temperature_2m'])
        ) {
            return null;
        }

        Cache::put(
            $cacheKey,
            $weather,
            now()->addHours(1)
        );

        return $weather;
    }
}
