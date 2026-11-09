<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum_Participation extends Model
{
    protected $table = 'forum_participation';

    protected $primaryKey = 'forum_participation_id';

    protected $fillable = [
        'forum_id',
        'user_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    public function forum()
    {
        return $this->belongsTo(
            Forum::class,
            'forum_id',
            'forum_id'
        );
    }
}
