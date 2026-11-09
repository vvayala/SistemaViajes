<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\TripType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with('tripType')
            ->where('user_id', Auth::user()->user_id)
            ->latest()
            ->get();

        return view('trip.index', compact('trips'));
    }

    public function create()
    {
        $tripTypes = TripType::orderBy('name')->get();

        return view('trip.create', compact('tripTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'number_of_people' => 'required|integer|min:1',
            'trip_type_id' => 'required'
        ]);

        Trip::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'number_of_people' => $request->number_of_people,
            'trip_type_id' => $request->trip_type_id,
            'user_id' => Auth::user()->user_id,
        ]);

        return redirect()
            ->route('trip.index')
            ->with('success', 'Viaje creado correctamente.');
    }

    public function show($trip_id)
    {
        $trip = Trip::with([
            'user',
            'tripType'
        ])->findOrFail($trip_id);

        return view('trip.show', compact('trip'));
    }

    public function destroy($trip_id)
    {
        $trip = Trip::findOrFail($trip_id);

        $trip->delete();

        return redirect()
            ->route('trip.index')
            ->with('success', 'Viaje eliminado correctamente.');
    }

    public function edit($trip_id)
{
    $trip = Trip::findOrFail($trip_id);

    if ($trip->user_id != Auth::user()->user_id) {
        abort(403);
    }

    $tripTypes = TripType::orderBy('name')->get();

    return view('trip.edit', compact(
        'trip',
        'tripTypes'
    ));
}

public function update(Request $request, $trip_id)
{
    $trip = Trip::findOrFail($trip_id);

    if ($trip->user_id != Auth::user()->user_id) {
        abort(403);
    }

    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'number_of_people' => 'required|integer|min:1',
        'trip_type_id' => 'required'
    ]);

    $trip->update([
        'title' => $request->title,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'number_of_people' => $request->number_of_people,
        'trip_type_id' => $request->trip_type_id,
    ]);

    return redirect()
        ->route('trip.index')
        ->with(
            'success',
            'Viaje actualizado correctamente.'
        );
    }

}