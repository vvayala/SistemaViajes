<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (
            strtolower(
                $user->role->name
            ) === 'admin'
        ) {

            return redirect()->route(
                'chat.support.index'
            );

        }

        $chats = Chat::with([
                'messages'
            ])
            ->where(
                'user_id',
                $user->user_id
            )
            ->latest()
            ->paginate(10);

        return view(
            'chat.index',
            compact('chats')
        );
    }

    public function supportIndex()
    {
        $chats = Chat::with([
                'user',
                'messages'
            ])
            ->latest()
            ->paginate(15);

        return view(
            'chat.support.index',
            compact('chats')
        );
    }

    public function create()
    {
        return view(
            'chat.create'
        );
    }

    public function store(
        Request $request
    )
    {
        $request->validate([
            'title' =>
                'required|string|max:255',

            'description' =>
                'required|string|max:1000',

            'message' =>
                'required|string|max:2000',
        ]);

        $chat = Chat::create([
            'user_id' =>
                auth()->user()->user_id,

            'title' =>
                $request->title,

            'description' =>
                $request->description,
        ]);

        ChatMessage::create([
            'chat_id' =>
                $chat->chat_id,

            'sender_id' =>
                auth()->user()->user_id,

            'message' =>
                $request->message,

            'is_read' =>
                false,
        ]);

        return redirect()->route(
            'chat.show',
            $chat->chat_id
        );
    }

    public function show(
        Chat $chat
    )
    {
        ChatMessage::where(
            'chat_id',
            $chat->chat_id
        )
        ->where(
            'sender_id',
            '!=',
            auth()->user()->user_id
        )
        ->where(
            'is_read',
            false
        )
        ->update([
            'is_read' => true
        ]);

        $chat->load([
            'user',
            'messages.sender.role'
        ]);

        return view(
            'chat.show',
            compact('chat')
        );
    }

    public function storeMessage(
        Request $request,
        Chat $chat
    )
    {
        $request->validate([
            'message' =>
                'required|string|max:2000',
        ]);

        ChatMessage::create([
            'chat_id' =>
                $chat->chat_id,

            'sender_id' =>
                auth()->user()->user_id,

            'message' =>
                $request->message,

            'is_read' =>
                false,
        ]);

        return redirect()->route(
            'chat.show',
            $chat->chat_id
        );
    }
}