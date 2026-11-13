<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\Reservation;
use App\Services\FlightService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(private FlightService $flightService)
    {
    }

    public function my($itinerary_id)
    {
        $itinerary = Itinerary::where('itinerary_id', $itinerary_id)
            ->whereHas('trip', fn ($q) => $q->where('user_id', auth()->id()))
            ->firstOrFail();

        $reservations = Reservation::with('itinerary')
            ->where('user_id', auth()->id())
            ->where('itinerary_id', $itinerary_id)
            ->latest('reservation_id')
            ->get();

        return view('reservations.my', compact('reservations', 'itinerary'));
    }

    public function index($itinerary_id)
    {
        $itinerary = Itinerary::with(['activities.location.country'])
            ->where('itinerary_id', $itinerary_id)
            ->whereHas('trip', fn ($q) => $q->where('user_id', auth()->id()))
            ->firstOrFail();

        $countries = $itinerary->activities
            ->pluck('location.country')
            ->filter()
            ->unique('country_id')
            ->filter(fn ($country) => ! empty($country->iata))
            ->values();

        return view('reservations.index', compact('itinerary', 'countries'));
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'itinerary_id' => 'required|exists:itinerary,itinerary_id',
            'origin'       => 'required|string|size:3',
            'destination'  => 'required|string|size:3|different:origin',
            'date'         => 'required|date|after_or_equal:today',
            'passengers'   => 'required|integer|min:1|max:9',
        ]);

        $itinerary = Itinerary::with(['activities.location.country'])
            ->where('itinerary_id', $validated['itinerary_id'])
            ->whereHas('trip', fn ($q) => $q->where('user_id', auth()->id()))
            ->firstOrFail();

        $allowedIatas = $itinerary->activities
            ->pluck('location.country.iata')
            ->filter()
            ->unique()
            ->values();

        if (! $allowedIatas->contains($validated['origin'])
            || ! $allowedIatas->contains($validated['destination'])) {
            return back()
                ->withErrors(['origin' => 'Debes elegir países de las actividades de este itinerario.'])
                ->withInput();
        }

        $flights = $this->flightService->search(
            $validated['origin'],
            $validated['destination'],
            $validated['date'],
            (string) $validated['passengers'],
        );

        return view('reservations.results', compact('flights', 'validated', 'itinerary'));
    }

    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'itinerary_id'   => 'required|exists:itinerary,itinerary_id',
            'origin'         => 'required|string|size:3',
            'destination'    => 'required|string|size:3',
            'departure_time' => 'required|date',
            'arrival_time'   => 'required|date|after:departure_time',
            'airline'        => 'nullable|string|max:255',
            'flight_number'  => 'nullable|string|max:50',
            'price'          => 'required|numeric|min:0',
            'currency'       => 'required|string|size:3',
            'passengers'     => 'required|integer|min:1',
            'stops'          => 'required|integer|min:0',
        ]);

        // Autorización: el itinerario debe pertenecer al usuario
        $itinerary = Itinerary::where('itinerary_id', $validated['itinerary_id'])
            ->whereHas('trip', fn ($q) => $q->where('user_id', auth()->id()))
            ->firstOrFail();

        Reservation::create([
            'user_id'        => auth()->id(),
            'itinerary_id'   => $itinerary->itinerary_id,
            'origin'         => $validated['origin'],
            'destination'    => $validated['destination'],
            'departure_time' => $validated['departure_time'],
            'arrival_time'   => $validated['arrival_time'],
            'airline'        => $validated['airline'] ?? null,
            'flight_number'  => $validated['flight_number'] ?? null,
            'price'          => $validated['price'],
            'currency'       => $validated['currency'],
            'passengers'     => $validated['passengers'],
            'stops'          => $validated['stops'],
            'status'         => 'pending',
        ]);

        return redirect()
            ->route('reservations.my', $itinerary->itinerary_id)
            ->with('success', 'Reserva creada correctamente.');
    }

    public function cancel(Reservation $reservation)
    {
        abort_unless($reservation->user_id === auth()->id(), 403);

        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', 'Reserva cancelada.');
    }
}