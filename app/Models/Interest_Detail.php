<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest_Detail extends Model
{
    protected $table = 'interest_detail';

    protected $primaryKey = 'interest_detail_id';

    protected $fillable = [
        'user_id',
        'interest_id',
    ];
}
