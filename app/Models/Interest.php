<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $table = 'interest';

    protected $primaryKey = 'interest_id';

    protected $fillable = [
        'name',
    ];
    
}
