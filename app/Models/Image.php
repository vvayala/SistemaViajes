<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $primaryKey = 'image_id';

    protected $fillable = [
        'entity_type',
        'entity_id',
        'image_path',
        'is_primary',
    ];
}
