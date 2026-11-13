<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityReview;
use App\Models\BudgetType;
use App\Models\Country;
use App\Models\Interest_Detail;
use App\Models\Interest;
use App\Models\Trip;
use App\Models\TripType;
use App\Models\Wishlist;
use App\Models\WishlistDetail;
use App\Services\DistanceService;
use App\Services\GeocodingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Activity::with([
            'location.country',
            'tripType',
            'interest',
            'budgetType',
            'primaryImage',
        ]);

        // País
        if ($request->filled('country_id')) {

            $baseQuery->whereHas(
                'location.country',
                function ($q) use ($request) {

                    $q->where(
                        'country_id',
                        $request->country_id
                    );

                }
            );
        }

        // Tipo de viaje
        if ($request->filled('trip_type_id')) {

            $baseQuery->where(
                'trip_type_id',
                $request->trip_type_id
            );
        }

        // Interés
        if ($request->filled('interest_id')) {

            $baseQuery->where(
                'interest_id',
                $request->interest_id
            );
        }

        // Presupuesto
        if ($request->filled('budget_type_id')) {

            $baseQuery->where(
                'budget_type_id',
                $request->budget_type_id
            );
        }

        //Wishlist
        $wishlistIds = [];

        if (Auth::check()) {

            $wishlist = Wishlist::where(
                'user_id',
                Auth::user()->user_id
            )->first();

            if ($wishlist) {

                $wishlistIds = WishlistDetail::where(
                    'wishlist_id',
                    $wishlist->wishlist_id
                )
                ->pluck('activity_id')
                ->toArray();
            }
        }

        $recommendedActivities = collect();
        $otherActivities = collect();

        if (Auth::check()) {

            $userInterests = Interest_Detail::where(
                'user_id',
                Auth::user()->user_id
            )->pluck('interest_id');

            if ($userInterests->isNotEmpty()) {

                $recommendedActivities = (clone $baseQuery)
                    ->whereIn(
                        'interest_id',
                        $userInterests
                    )
                    ->take(3)
                    ->get();

                $otherActivities = (clone $baseQuery)
                    ->whereNotIn(
                        'interest_id',
                        $userInterests
                    )
                    ->paginate(6, ['*'],'page');

            } else {

                $otherActivities = $baseQuery->paginate(6, ['*'],'page');
            }

        } else {

            $otherActivities = $baseQuery->paginate(6, ['*'],'page');
        }

        return view('home', [
            'recommendedActivities' => $recommendedActivities,
            'otherActivities' => $otherActivities,
            'countries' => Country::orderBy('name')->get(),
            'tripTypes' => TripType::all(),
            'interests' => Interest::all(),
            'budgetTypes' => BudgetType::all(),
            'wishlistIds' =>$wishlistIds,
        ]);
    }

    public function show(
    Request $request,
    $activity_id
    ) {

        $activity = Activity::with([
            'location.country',
            'tripType',
            'interest',
            'budgetType',
            'primaryImage',
        ])->findOrFail($activity_id);

        $sort = $request->get(
            'sort',
            'best'
        );

        $reviewsQuery = ActivityReview::with([
            'user',
            'images'
        ])
        ->where(
            'activity_id',
            $activity_id
        );

        if ($sort === 'worst') {

            $reviewsQuery->orderBy(
                'rating',
                'asc'
            );

        } else {

            $reviewsQuery->orderBy(
                'rating',
                'desc'
            );
        }

        $reviews = $reviewsQuery
            ->paginate(
                3,
                ['*'],
                'reviews'
            );

        $averageRating = ActivityReview::where(
            'activity_id',
            $activity_id
        )
        ->avg('rating');

        $totalReviews = ActivityReview::where(
            'activity_id',
            $activity_id
        )
        ->count();

        $trips = Trip::with('itinerary')
        ->whereHas('itinerary')
        ->orderBy(
            'start_date',
            'desc'
        )
        ->get();

         //Wishlist
        $wishlistIds = [];

        if (Auth::check()) {

            $wishlist = Wishlist::where(
                'user_id',
                Auth::user()->user_id
            )->first();

            if ($wishlist) {

                $wishlistIds = WishlistDetail::where(
                    'wishlist_id',
                    $wishlist->wishlist_id
                )
                ->pluck('activity_id')
                ->toArray();
            }
        }

        return view(
            'activity.show',
            compact(
                'activity',
                'reviews',
                'averageRating',
                'totalReviews',
                'sort',
                'trips',
                'wishlistIds',
            )
        );
    }
}