<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistDetail extends Model
{
    protected $table = 'wishlist_detail';

    protected $primaryKey = 'wishlist_detail_id';

    protected $fillable = [
        'wishlist_id',
        'activity_id',
    ];

    public function wishlist()
    {
        return $this->belongsTo(
            Wishlist::class,
            'wishlist_id',
            'wishlist_id'
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
