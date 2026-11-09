<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityReviewController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumParticipationController;
use App\Http\Controllers\ItineraryActivityController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\NearbyController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [ActivityController::class, 'index'])
    ->name('home');

Auth::routes();

// Interests routes
Route::get('/interest', [App\Http\Controllers\InterestDetailController::class, 'index'])->name('interests.index');
Route::post('/interest', [App\Http\Controllers\InterestDetailController::class, 'store'])->name('interests.store');

//User profile
Route::get('/user/show/{user_id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('/user/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

//Forum routes
Route::get('/forum', [ForumController::class, 'index'])
    ->name('forum.index');

Route::get('/forum/create', [ForumController::class, 'create'])
    ->name('forum.create');

Route::post('/forum/store', [ForumController::class, 'store'])
    ->name('forum.store');

Route::get('/forum/my-forums', [ForumController::class, 'myForums'])
    ->name('forum.myForums');

Route::get('/forum/{forum_id}', [ForumController::class, 'show'])
    ->name('forum.show');

Route::delete('/forum/{forum_id}', [ForumController::class, 'destroy'])
    ->name('forum.destroy');

Route::post('/forum/participation/store',
    [ForumParticipationController::class, 'store'])
    ->name('forum.participation.store');

//Trip

Route::get('/trip', [TripController::class, 'index'])
    ->name('trip.index');

Route::get('/trip/create', [TripController::class, 'create'])
    ->name('trip.create');

Route::post('/trip/store', [TripController::class, 'store'])
    ->name('trip.store');

Route::get('/trip/{trip_id}', [TripController::class, 'show'])
    ->name('trip.show');

Route::delete('/trip/{trip_id}', [TripController::class, 'destroy'])
    ->name('trip.destroy');

Route::get('trip/{trip_id}/edit', [TripController::class, 'edit'])
    ->name('trip.edit');

Route::put('trip/{trip_id}', [TripController::class, 'update'])
    ->name('trip.update');
  
//Wishlist Routes

Route::get('wishlist', [WishlistController::class, 'index'])
    ->name('wishlist.index');

Route::post('wishlist', [WishlistController::class, 'store'])
    ->name('wishlist.store');

Route::delete('wishlist/{activityId}',[WishlistController::class, 'destroy'])
    ->name('wishlist.destroy');

//Activity

Route::get('activity/{activity_id}', [ActivityController::class, 'show'])
    ->name('activity.show');

//Reservation

Route::get('trip/{trip_id}/reservations', [ReservationController::class, 'index'])
    ->name('reservation.index');

Route::get('trip/{trip_id}/reservations/create', [ReservationController::class, 'create'])
    ->name('reservation.create');

Route::post('reservations', [ReservationController::class, 'store'])
    ->name('reservation.store');

Route::delete('reservation/{reservation_id}', [ReservationController::class, 'destroy'])
    ->name('reservation.destroy');

//Itinerary

Route::get(
    'trip/{trip_id}/itineraries', [ItineraryController::class, 'index'])
    ->name('itinerary.index');

Route::get('trip/{trip_id}/itineraries/create', [ItineraryController::class, 'create'])
    ->name('itinerary.create');

Route::post('itinerary', [ItineraryController::class, 'store'])
    ->name('itinerary.store');

Route::get('itinerary/{itinerary_id}', [ItineraryController::class, 'show'])
    ->name('itinerary.show');

Route::get('itinerary/{itinerary_id}/edit', [ItineraryController::class, 'edit'])
    ->name('itinerary.edit');

Route::put('itinerary/{itinerary_id}', [ItineraryController::class, 'update'])
    ->name('itinerary.update');

Route::delete('itinerary/{itinerary_id}', [ItineraryController::class, 'destroy'])
    ->name('itinerary.destroy');

//Itinerary Activity

Route::post('itinerary-activity', [ItineraryActivityController::class, 'store'])
    ->name('itinerary.activity.store');

Route::delete('itinerary-activity/{id}', [ItineraryActivityController::class, 'destroy'])
    ->name('itinerary.activity.destroy');


//Reviews

Route::get(
    '/activities/{activity}/review/create', [ActivityReviewController::class, 'create'])
    ->name('reviews.create');

Route::post('/activities/{activity}/review', [ActivityReviewController::class, 'store'])
    ->name('reviews.store');

//Offline
Route::get('/offline',function () {return view('offline.index');
    }
)->name('offline.index');

//Nearby
Route::get('/nearby',[NearbyController::class, 'index'])
    ->name('nearby.index');

//Chats
Route::get('chat/create', [ChatController::class, 'create'])
    ->name('chat.create');

Route::post('chat', [ChatController::class, 'store'])
    ->name('chat.store');
    
Route::resource('chat', ChatController::class)
    ->only(['index','show']);

Route::post('chat/{chat}/message', [ChatController::class, 'storeMessage'])
    ->name('chat.message.store');

Route::middleware(['auth','admin'])->group(function () {
    Route::get(
        '/support/chats',
        [ChatController::class, 'supportIndex']
    )->name('chat.support.index');
});

