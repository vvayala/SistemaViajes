<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;
use App\Models\ItineraryActivity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ItineraryActivityController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'itinerary_id' => 'required|exists:itinerary,itinerary_id',
            'activity_id' => 'required|exists:activity,activity_id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $itinerary = Itinerary::with('trip')
            ->findOrFail(
                $request->itinerary_id
            );

        $tripStart = Carbon::parse(
            $itinerary->trip->start_date
        )->startOfDay();

        $tripEnd = Carbon::parse(
            $itinerary->trip->end_date
        )->endOfDay();

        $start = Carbon::parse(
            $request->start_time
        );

        $end = Carbon::parse(
            $request->end_time
        );

        if (
            $start->lt($tripStart)
            ||
            $start->gt($tripEnd)
            ||
            $end->lt($tripStart)
            ||
            $end->gt($tripEnd)
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_time' =>
                    'La actividad debe programarse dentro del rango de fechas del viaje.'
                ]);
        }

        $alreadyExists = ItineraryActivity::where(
            'itinerary_id',
            $request->itinerary_id
        )
        ->where(
            'activity_id',
            $request->activity_id
        )
        ->exists();

        if ($alreadyExists) {

            return back()
                ->withErrors([
                    'activity_id' =>
                    'Esta actividad ya fue agregada al itinerario.'
                ]);
        }

        ItineraryActivity::create([
            'itinerary_id' => $request->itinerary_id,
            'activity_id' => $request->activity_id,
            'start_time' => $start,
            'end_time' => $end,
        ]);

        return back()
            ->with(
                'success',
                'Actividad agregada al itinerario correctamente.'
            );
    }

    public function destroy($itinerary_activity_id)
    {
        $itineraryActivity = ItineraryActivity::findOrFail(
            $itinerary_activity_id
        );

        $itineraryActivity->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'Actividad eliminada del itinerario.'
            );
    }
}
