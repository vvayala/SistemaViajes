<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityReview;
use App\Models\ItineraryActivity;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Services\CloudinaryService;

class ActivityReviewController extends Controller
{
    public function create(Activity $activity)
    {
        $canReview = ItineraryActivity::where(
            'activity_id',
            $activity->activity_id
        )
        ->whereHas('itinerary.trip', function ($query) {

            $query->where(
                'user_id',
                auth()->id()
            );

        })
        ->exists();

        if (!$canReview) {

            return back()->withErrors([
                'review' =>
                    'Debes agregar esta actividad a uno de tus viajes antes de reseñarla.'
            ]);
        }

        $alreadyReviewed = ActivityReview::where(
            'activity_id',
            $activity->activity_id
        )
        ->where(
            'user_id',
            auth()->id()
        )
        ->exists();

        if ($alreadyReviewed) {

            return back()->withErrors([
                'review' =>
                    'Ya reseñaste esta actividad.'
            ]);
        }

        return view(
            'reviews.create',
            compact('activity')
        );
    }

    public function store(
        Request $request,
        Activity $activity
    )
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],
        ]);

        $canReview = ItineraryActivity::where(
            'activity_id',
            $activity->activity_id
        )
        ->whereHas('itinerary', function ($query) {

            $query->whereHas('trip', function ($tripQuery) {

                $tripQuery->where(
                    'user_id',
                    auth()->user()->user_id
                );

            });

        })
        ->exists();

        if (!$canReview) {

            return back()
                ->withInput()
                ->withErrors([
                    'review' =>
                    'Debes haber agregado esta actividad a uno de tus viajes para poder reseñarla.'
                ]);
        }

        $alreadyReviewed = ActivityReview::where(
            'activity_id',
            $activity->activity_id
        )
        ->where(
            'user_id',
            auth()->user()->user_id
        )
        ->exists();

        if ($alreadyReviewed) {

            return back()
                ->withErrors([
                    'review' =>
                    'Ya has publicado una reseña para esta actividad.'
                ]);
        }

        $review = ActivityReview::create([
            'rating' => $request->rating,
            'title' => $request->title,
            'description' => $request->description,
            'activity_id' => $activity->activity_id,
            'user_id' => auth()->user()->user_id,
        ]);

        if ($request->hasFile('images')) {

    foreach (
        $request->file('images')
        as $index => $file
    ) {

            $imageUrl =
                $this->cloudinaryService
                ->upload(
                    $file,
                    'SistemaViajes/ActivityReview'
                );

            Image::create([
                'entity_type' => 'ActivityReview',
                'entity_id' => $review->activity_review_id,
                'image_path' => $imageUrl,
                'is_primary' => $index === 0,
            ]);
        }

    }

        return redirect()
            ->route(
                'activity.show',
                $activity->activity_id
            )
            ->with(
                'success',
                'Reseña publicada correctamente.'
            );
    }

    protected CloudinaryService $cloudinaryService;

    public function __construct(
        CloudinaryService $cloudinaryService
    ) {
        $this->cloudinaryService = $cloudinaryService;
    }


}
