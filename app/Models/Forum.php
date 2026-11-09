<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Forum_Participation;

class Forum extends Model
{
    protected $table = 'forum';

    protected $primaryKey = 'forum_id';

    protected $fillable = [
        'title',
        'description',
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

    public function participations()
    {
        return $this->hasMany(
            Forum_Participation::class,
            'forum_id',
            'forum_id'
        );
    }

    public function images()
    {
        return $this->hasMany(
            Image::class,
            'entity_id',
            'forum_id'
        )->where(
            'entity_type',
            'Forum'
        );
    }
}
