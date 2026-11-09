<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationType extends Model
{
    protected $table = 'reservation_type';

    protected $primaryKey = 'reservation_type_id';

    protected $fillable = [
        'name',
    ];
}
