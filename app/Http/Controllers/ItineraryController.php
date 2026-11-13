<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\BudgetType;
use App\Models\Country;
use App\Models\Itinerary;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function index($trip_id)
    {
        $trip = Trip::findOrFail($trip_id);

        $itineraries = Itinerary::where(
            'trip_id',
            $trip_id
        )
        ->latest()
        ->get();

        return view(
            'itinerary.index',
            compact(
                'trip',
                'itineraries'
            )
        );
    }

    public function create($trip_id)
    {
        $trip = Trip::findOrFail($trip_id);

        return view(
            'itinerary.create',
            compact('trip')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'trip_id' => 'required|exists:trip,trip_id'
        ]);

        Itinerary::create([
            'name' => $request->name,
            'description' => $request->description,
            'trip_id' => $request->trip_id,
        ]);

        return redirect()
            ->route(
                'itinerary.index',
                $request->trip_id
            )
            ->with(
                'success',
                'Itinerario creado correctamente.'
            );
    }


    public function edit($itinerary_id)
    {
        $itinerary = Itinerary::findOrFail(
            $itinerary_id
        );

        return view(
            'itinerary.edit',
            compact('itinerary')
        );
    }

    public function update(
        Request $request,
        $itinerary_id
    ) {

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $itinerary = Itinerary::findOrFail(
            $itinerary_id
        );

        $itinerary->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route(
                'itinerary.show',
                $itinerary->itinerary_id
            )
            ->with(
                'success',
                'Itinerario actualizado correctamente.'
            );
    }

    public function destroy($itinerary_id)
    {
        $itinerary = Itinerary::findOrFail(
            $itinerary_id
        );

        $tripId = $itinerary->trip_id;

        $itinerary->delete();

        return redirect()
            ->route(
                'itinerary.index',
                $tripId
            )
            ->with(
                'success',
                'Itinerario eliminado.'
            );
    }

public function show(
    Request $request,
    $itinerary_id
) {

    $itinerary = Itinerary::with([
        'trip',
        'activities.primaryImage',
        'activities.location.country'
    ])->findOrFail($itinerary_id);

    $tripMonth = Carbon::parse(
        $itinerary->trip->start_date
    )->month;

    $query = Activity::with([
        'primaryImage',
        'tripType',
        'interest',
        'budgetType',
        'location.country'
    ]);

    if ($request->filled('country_id')) {

        $query->whereHas(
            'location',
            function ($q) use ($request) {

                $q->where(
                    'country_id',
                    $request->country_id
                );
            }
        );
    }

    if ($request->filled('budget_type_id')) {

        $query->where(
            'budget_type_id',
            $request->budget_type_id
        );
    }

    $activities = $query
        ->orderBy('name')
        ->get();

    /*
     * Temporada actividades disponibles
     */

    foreach ($activities as $activity) {

        $activity->season_name =
            $this->getSeasonName(
                $activity->location->country->name,
                $tripMonth
            );
    }

    /*
     * Filtrar por temporada
     */

    if ($request->filled('season')) {
        $activities = $activities->filter(function ($activity) use ($request) {
            return $activity->season_name === $request->season;
        })->values();
    }

    /*
     * Cronograma
     */

    $scheduledActivities = $itinerary
        ->activities
        ->sortBy('pivot.start_time');

    foreach ($scheduledActivities as $activity) {

        $month = Carbon::parse(
            $activity->pivot->start_time
        )->month;

        $activity->season_name =
            $this->getSeasonName(
                $activity->location->country->name,
                $month
            );
    }

    $countries = Country::orderBy(
        'name'
    )->get();

    $budgetTypes = BudgetType::orderBy(
        'name'
    )->get();

    return view(
        'itinerary.show',
        compact(
            'itinerary',
            'activities',
            'scheduledActivities',
            'countries',
            'budgetTypes'
        )
    );
}

private function getSeasonName(
    string $countryName,
    int $month
): string {

    $northAmerica = [
        'Estados Unidos',
        'Canadá',
        'México'
    ];

    $centralAmerica = [
        'Guatemala',
        'El Salvador',
        'Honduras',
        'Nicaragua',
        'Costa Rica',
        'Panamá',
        'Belice'
    ];

    $southAmerica = [
        'Argentina',
        'Brasil',
        'Chile',
        'Colombia',
        'Perú',
        'Uruguay',
        'Paraguay',
        'Ecuador',
        'Bolivia',
        'Venezuela'
    ];

    $europe = [
        'España',
        'Francia',
        'Italia',
        'Alemania',
        'Reino Unido',
        'Portugal',
        'Países Bajos',
        'Suiza',
        'Grecia',
        'Austria'
    ];

    $asia = [
        'Japón',
        'China',
        'India',
        'Corea del Sur',
        'Tailandia',
        'Vietnam',
        'Indonesia',
        'Filipinas',
        'Malasia',
        'Singapur'
    ];

    $africa = [
        'Sudáfrica',
        'Egipto',
        'Marruecos',
        'Kenia',
        'Tanzania',
        'Nigeria',
        'Ghana',
        'Túnez'
    ];

    $oceania = [
        'Australia',
        'Nueva Zelanda',
        'Fiyi',
        'Papúa Nueva Guinea',
        'Samoa',
        'Tonga',
        'Vanuatu',
        'Palau'
    ];

    if (in_array($countryName, $northAmerica)) {

        if ($month >= 6 && $month <= 8)
            return 'Alta';

        if ($month >= 4 && $month <= 5)
            return 'Media';

        return 'Baja';
    }

    if (in_array($countryName, $centralAmerica)) {

        if ($month >= 12 || $month <= 4)
            return 'Alta';

        if ($month >= 5 && $month <= 8)
            return 'Media';

        return 'Baja';
    }

    if (in_array($countryName, $southAmerica)) {

        if ($month >= 12 || $month <= 2)
            return 'Alta';

        if ($month >= 3 && $month <= 5)
            return 'Media';

        return 'Baja';
    }

    if (in_array($countryName, $europe)) {

        if ($month >= 6 && $month <= 9)
            return 'Alta';

        if ($month >= 4 && $month <= 5)
            return 'Media';

        return 'Baja';
    }

    if (in_array($countryName, $asia)) {

        if ($month >= 11 || $month <= 2)
            return 'Alta';

        if ($month >= 3 && $month <= 5)
            return 'Media';

        return 'Baja';
    }

    if (in_array($countryName, $africa)) {

        if ($month >= 10 || $month <= 3)
            return 'Alta';

        if ($month >= 4 && $month <= 6)
            return 'Media';

        return 'Baja';
    }

    if (in_array($countryName, $oceania)) {

        if ($month >= 12 || $month <= 2)
            return 'Alta';

        if ($month >= 3 && $month <= 5)
            return 'Media';

        return 'Baja';
    }

    return 'Media';
}

}