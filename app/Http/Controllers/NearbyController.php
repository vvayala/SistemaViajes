<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class NearbyController extends Controller
{
    protected WeatherService $weatherService;

    public function __construct(
        WeatherService $weatherService
    ) {
        $this->weatherService = $weatherService;
    }

    public function index(
        Request $request
    ) {
        $lat = $request->lat;
        $lng = $request->lng;

        $query = Activity::query()
            ->with([
                'location.country',
                'primaryImage'
            ])
            ->whereHas('location', function ($query) {

                $query
                    ->whereNotNull('latitude')
                    ->whereNotNull('longitude');

            });

        if ($lat && $lng) {

            $query
                ->join(
                    'location',
                    'activity.location_id',
                    '=',
                    'location.location_id'
                )
                ->select('activity.*')
                ->selectRaw(
                    '
                    (
                        6371 *
                        acos(
                            cos(radians(?))
                            *
                            cos(radians(location.latitude))
                            *
                            cos(
                                radians(location.longitude)
                                -
                                radians(?)
                            )
                            +
                            sin(radians(?))
                            *
                            sin(
                                radians(location.latitude)
                            )
                        )
                    ) as distance
                    ',
                    [
                        $lat,
                        $lng,
                        $lat
                    ]
                )
                ->orderBy('distance')
                ->limit(20);

        } else {

            $query->limit(20);

        }

        $activities = $query->get();

        foreach ($activities as $activity) {

            $weather =
                $this->weatherService
                ->getWeather(
                    $activity->location->latitude,
                    $activity->location->longitude
                );

            $activity->temperature =
                $weather['current']['temperature_2m']
                ?? null;
        }

        $markers = $activities->map(function ($activity) {

            return [

                'id' =>
                    $activity->activity_id,

                'name' =>
                    $activity->name,

                'city' =>
                    $activity->location->city,

                'country' =>
                    $activity->location->country->name,

                'latitude' =>
                    $activity->location->latitude,

                'longitude' =>
                    $activity->location->longitude,

                'temperature' =>
                    $activity->temperature,

                'distance' =>
                    round(
                        $activity->distance ?? 0,
                        1
                    ),

                'url' =>
                    route(
                        'activity.show',
                        $activity->activity_id
                    ),

            ];

        });

        return view(
            'nearby.index',
            compact(
                'activities',
                'markers'
            )
        );
    }
}