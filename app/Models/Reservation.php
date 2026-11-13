<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'user_id', 'origin', 'destination', 'departure_time', 'arrival_time',
        'airline', 'flight_number', 'price', 'currency', 'passengers', 'stops', 'status', 'itinerary_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class, 'itinerary_id', 'itinerary_id');
    }

}
