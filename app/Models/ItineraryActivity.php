<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItineraryActivity extends Model
{
    protected $table = 'itinerary_activity';

    protected $primaryKey = 'itinerary_activity_id';

    protected $fillable = [
        'activity_id',
        'itinerary_id',
        'start_time',
        'end_time',
    ];
    
    public function itinerary()
    {
        return $this->belongsTo(
            Itinerary::class,
            'itinerary_id',
            'itinerary_id'
        );
    }

        public function activity()
    {
        return $this->belongsTo(
            Activity::class,
            'activity_id',
            'activity_id'
        );
    }
}
