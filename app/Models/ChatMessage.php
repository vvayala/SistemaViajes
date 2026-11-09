<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_message';

    protected $primaryKey = 'chat_message_id';

    protected $fillable = [
        'chat_id',
        'sender_id',
        'message',
        'is_read'
    ];

    public function chat()
    {
        return $this->belongsTo(
            Chat::class,
            'chat_id',
            'chat_id'
        );
    }

    public function sender()
    {
        return $this->belongsTo(
            User::class,
            'sender_id',
            'user_id'
        );
    }

    public function images()
    {
        return $this->hasMany(
            Image::class,
            'entity_id',
            'chat_message_id'
        )->where(
            'entity_type',
            'ChatMessage'
        );
    }

}
