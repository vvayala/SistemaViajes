<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;
use App\Models\Interest_Detail as InterestDetail;
use Illuminate\Support\Facades\Auth;
class InterestDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interests = Interest::all();

        $selectedInterests = InterestDetail::where(
            'user_id',
            auth()->user()->user_id
        )->pluck('interest_id')
        ->toArray();

        return view(
            'interest.index',
            compact(
                'interests',
                'selectedInterests'
            )
        );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'interests' => 'required|array|min:1',
        'interests.*' => 'exists:interest,interest_id'
    ]);

    $user = Auth::user();

    InterestDetail::where(
        'user_id',
        $user->user_id
    )->delete();

    $interests = collect($request->interests)
        ->map(function ($interestId) use ($user) {
            return [
                'user_id' => $user->user_id,
                'interest_id' => $interestId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })
        ->toArray();

    InterestDetail::insert($interests);

    return redirect()
        ->route('home')
        ->with(
            'success',
            'Intereses guardados correctamente.'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
