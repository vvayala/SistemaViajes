<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityReview extends Model
{
    protected $table = 'activity_review';

    protected $primaryKey = 'activity_review_id';

    protected $fillable = [
        'rating',
        'title',
        'description',
        'activity_id',
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

    public function activity()
    {
        return $this->belongsTo(
            Activity::class,
            'activity_id',
            'activity_id'
        );
    }

    public static function canReview($userId, $activityId)
    {
        return \App\Models\ItineraryActivity::where('activity_id', $activityId)
            ->whereHas('itinerary.trip', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->exists();
    }

    public function images()
    {
        return $this->hasMany(
            Image::class,
            'entity_id',
            'activity_review_id'
        )->where(
            'entity_type',
            'ActivityReview'
        );
    }
}
