<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\WishlistDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::with([
        'details.activity.primaryImage',
        'details.activity.location.country',
        'details.activity.tripType',
        'details.activity.interest',
        'details.activity.budgetType',
    ])
    ->where('user_id', Auth::user()->user_id)
    ->first();

        return view('wishlist.index', compact('wishlist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activity,activity_id',
        ]);

        $wishlist = Wishlist::firstOrCreate(
            [
                'user_id' => Auth::user()->user_id,
            ],
            [
                'title' => 'Mi Wishlist',
            ]
        );

        WishlistDetail::firstOrCreate(
            [
                'wishlist_id' => $wishlist->wishlist_id,
                'activity_id' => $request->activity_id,
            ]
        );

        return back()->with(
            'success',
            'Actividad agregada a favoritos.'
        );
    }

    public function destroy($activityId)
    {
        $wishlist = Wishlist::where(
            'user_id',
            Auth::user()->user_id
        )->first();

        if ($wishlist) {

            WishlistDetail::where(
                'wishlist_id',
                $wishlist->wishlist_id
            )
            ->where(
                'activity_id',
                $activityId
            )
            ->delete();
        }

        return back()->with(
            'success',
            'Actividad eliminada de favoritos.'
        );
    }

}
