<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $table = 'itinerary';

    protected $primaryKey = 'itinerary_id';

    protected $fillable = [
        'name',
        'description',
        'trip_id'
    ];

    public function activities()
{
    return $this->belongsToMany(
        Activity::class,
        'itinerary_activity',
        'itinerary_id',
        'activity_id'
    )
    ->withPivot([
        'itinerary_activity_id',
        'start_time',
        'end_time'
    ]);
}

public function trip()
{
    return $this->belongsTo(
        Trip::class,
        'trip_id',
        'trip_id'
    );
}

}
