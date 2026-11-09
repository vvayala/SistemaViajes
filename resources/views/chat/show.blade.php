@extends('layouts.app')

@section('title', $chat->title)

@section('content')

<div class="container">

    <div class="mb-3">

        @if (
            auth()->user()->role->name === 'admin'
        )

            <a
                href="{{ route('chat.support.index') }}"
                class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>
                Volver a chats

            </a>

        @else

            <a
                href="{{ route('chat.index') }}"
                class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>
                Volver a mis chats

            </a>

        @endif

    </div>

    <div class="card shadow-sm mb-3">

        <div class="card-body">

            <h3 class="mb-1">
                {{ $chat->title }}
            </h3>

            <p class="text-muted mb-0">
                {{ $chat->description }}
            </p>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-header">

            <h5 class="mb-0">

                <i class="bi bi-chat-dots-fill me-2"></i>

                Conversación

            </h5>

        </div>

        <div class="card-body">

            @forelse ($chat->messages as $message)

                <div
                    class="mb-3
                    {{ $message->sender_id == auth()->user()->user_id ? 'text-end' : '' }}">

                    <div>

                        <strong>

                            @if (
                                strtolower(
                                    $message->sender->role->name
                                ) === 'admin'
                            )

                                Admin

                            @else

                                {{ $message->sender->name }}

                            @endif

                        </strong>

                        @if ($message->is_read)

                            <span
                                class="badge bg-success ms-1">

                                Leído

                            </span>

                        @else

                            <span
                                class="badge bg-warning text-dark ms-1">

                                Pendiente

                            </span>

                        @endif

                    </div>

                    <div
                        class="
                        d-inline-block
                        mt-1
                        p-3
                        rounded
                        {{ $message->sender_id == auth()->user()->user_id
                            ? 'bg-primary text-white'
                            : 'bg-light' }}
                        "
                        style="max-width: 75%;">

                        {{ $message->message }}

                    </div>

                </div>

            @empty

                <div class="alert alert-info">

                    No existen mensajes en esta conversación.

                </div>

            @endforelse

        </div>

    </div>

    <div class="card shadow-sm mt-3">

        <div class="card-body">

            <form
                action="{{ route('chat.message.store', $chat->chat_id) }}"
                method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">

                        Respuesta

                    </label>

                    <textarea
                        name="message"
                        class="form-control"
                        rows="4"
                        required></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-send-fill"></i>
                    Enviar mensaje

                </button>

            </form>

        </div>

    </div>

</div>

@endsection