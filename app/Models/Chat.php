<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    protected $primaryKey = 'chat_id';

    protected $fillable = [
        'user_id',
        'title',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    public function messages()
    {
        return $this->hasMany(
            ChatMessage::class,
            'chat_id',
            'chat_id'
        );
    }
}
