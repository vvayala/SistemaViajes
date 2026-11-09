<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripType extends Model
{
    protected $table = 'trip_type';

    protected $primaryKey = 'trip_type_id';

    protected $fillable = [
        'name',
    ];

    public function trips()
    {
        return $this->hasMany(
            Trip::class,
            'trip_type_id',
            'trip_type_id'
        );
    }
}
