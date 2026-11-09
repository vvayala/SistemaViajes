<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
        'trip_id',
        'reservation_type_id',
        'activity_id',
    ];

    public function activity()
    {
        return $this->belongsTo(
            Activity::class,
            'activity_id',
            'activity_id'
        );
    }

    public function reservationType()
    {
        return $this->belongsTo(
            ReservationType::class,
            'reservation_type_id',
            'reservation_type_id'
        );
    }
}
