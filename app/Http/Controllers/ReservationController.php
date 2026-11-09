<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItineraryActivity;
use App\Models\Reservation;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Models\ReservationType;

class ReservationController extends Controller
{
    public function index($trip_id)
    {
        $trip = Trip::findOrFail($trip_id);

        $reservations = Reservation::with([
            'activity',
            'reservationType'
        ])
        ->where(
            'trip_id',
            $trip_id
        )
        ->orderBy('reservation_type_id')
        ->get();

        $totalAmount = $reservations->sum(function ($reservation) {
            return $reservation->price * $reservation->quantity;
        });

        return view(
            'reservation.index',
            compact(
                'trip',
                'reservations',
                'totalAmount'
            )
        );
    }

    public function create($trip_id)
    {
        $trip = Trip::findOrFail($trip_id);

        $activities = ItineraryActivity::query()
            ->join(
                'itinerary',
                'itinerary.itinerary_id',
                '=',
                'itinerary_activity.itinerary_id'
            )
            ->join(
                'activity',
                'activity.activity_id',
                '=',
                'itinerary_activity.activity_id'
            )
            ->where(
                'itinerary.trip_id',
                $trip_id
            )
            ->select(
                'activity.activity_id',
                'activity.name'
            )
            ->distinct()
            ->orderBy('activity.name')
            ->get();

        $reservationTypes = ReservationType::orderBy(
            'name'
        )->get();

        return view(
            'reservation.create',
            compact(
                'trip',
                'activities',
                'reservationTypes'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable',
            'trip_id' => 'required|exists:trip,trip_id',
            'reservation_type_id' =>
                'required|exists:reservation_type,reservation_type_id',
            'activity_id' =>
                'nullable|exists:activity,activity_id',
        ]);

        if ($request->filled('activity_id')) {

            $exists = ItineraryActivity::query()
                ->join(
                    'itinerary',
                    'itinerary.itinerary_id',
                    '=',
                    'itinerary_activity.itinerary_id'
                )
                ->where(
                    'itinerary.trip_id',
                    $request->trip_id
                )
                ->where(
                    'itinerary_activity.activity_id',
                    $request->activity_id
                )
                ->exists();

            if (!$exists) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'activity_id' =>
                            'La actividad seleccionada no pertenece al itinerario del viaje.'
                    ]);
            }
        }

        Reservation::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'trip_id' => $request->trip_id,
            'reservation_type_id' => $request->reservation_type_id,
            'activity_id' => $request->activity_id,
        ]);

        return redirect()
            ->route(
                'reservation.index',
                $request->trip_id
            )
            ->with(
                'success',
                'Reserva registrada correctamente.'
            );
    }

    public function destroy($reservation_id)
    {
        $reservation = Reservation::findOrFail(
            $reservation_id
        );

        $tripId = $reservation->trip_id;

        $reservation->delete();

        return redirect()
            ->route(
                'reservation.index',
                $tripId
            )
            ->with(
                'success',
                'Reserva eliminada correctamente.'
            );
    }

}
