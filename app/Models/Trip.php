<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TripType;

class Trip extends Model
{
    protected $table = 'trip';

    protected $primaryKey = 'trip_id';

    protected $fillable = [
        'start_date',
        'end_date',
        'number_of_people',
        'title',
        'description',
        'trip_type_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    public function tripType()
    {
        return $this->belongsTo(
            TripType::class,
            'trip_type_id',
            'trip_type_id'
        );
    }

    public function itinerary()
    {
        return $this->hasOne(
            Itinerary::class,
            'trip_id',
            'trip_id'
        );
    }
}
