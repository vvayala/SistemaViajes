<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';

    protected $primaryKey = 'activity_id';

    protected $fillable = [
        'name',
        'description',
        'location_id',
        'budget_type_id',
        'trip_type_id',
        'interest_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
    }

    public function tripType()
    {
        return $this->belongsTo(
            TripType::class,
            'trip_type_id',
            'trip_type_id'
        );
    }

    public function interest()
    {
        return $this->belongsTo(
            Interest::class,
            'interest_id',
            'interest_id'
        );
    }

    public function budgetType()
    {
        return $this->belongsTo(
            BudgetType::class,
            'budget_type_id',
            'budget_type_id'
        );
    }

    public function primaryImage()
    {
        return $this->hasOne(
            Image::class,
            'entity_id',
            'activity_id'
        )
        ->where('entity_type', 'activity')
        ->where('is_primary', true);
    }

    public function reviews()
{
    return $this->hasMany(
        ActivityReview::class,
        'activity_id',
        'activity_id'
    );
}

public function itineraries()
{
    return $this->belongsToMany(
        Itinerary::class,
        'itinerary_activity',
        'activity_id',
        'itinerary_id'
    );
}

}
