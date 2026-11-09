@extends('layouts.app')

@section('title', 'Mis Chats')

@section('content')

<div class="container">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="section-title mb-0">

            <i class="bi bi-chat-dots-fill me-2"></i>
            Mis Chats

        </h2>

        <a
            href="{{ route('chat.create') }}"
            class="btn btn-primary">

            <i class="bi bi-plus-circle-fill"></i>
            Nuevo Chat

        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            @forelse($chats as $chat)

                @php

                    $unreadCount =
                        $chat->messages
                        ->where(
                            'is_read',
                            false
                        )
                        ->count();

                @endphp

                <div
                    class="border-bottom p-3">

                    <div
                        class="d-flex justify-content-between align-items-start">

                        <div>

                            <h5 class="mb-1">

                                {{ $chat->title }}

                            </h5>

                            <p
                                class="text-muted mb-2">

                                {{ $chat->description }}

                            </p>

                            <small
                                class="text-secondary">

                                {{ $chat->messages->count() }}
                                mensajes

                            </small>

                        </div>

                        <div class="text-end">

                            @if($unreadCount > 0)

                                <span
                                    class="badge bg-warning text-dark">

                                    {{ $unreadCount }}
                                    pendientes

                                </span>

                            @else

                                <span
                                    class="badge bg-success">

                                    Al día

                                </span>

                            @endif

                            <br>

                            <a
                                href="{{ route(
                                    'chat.show',
                                    $chat->chat_id
                                ) }}"
                                class="btn btn-sm btn-primary mt-2">

                                <i class="bi bi-chat-text-fill"></i>
                                Abrir

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="p-4 text-center">

                    <i
                        class="bi bi-chat-square-text fs-1 text-muted">
                    </i>

                    <p class="mt-3">

                        No tienes conversaciones de soporte.

                    </p>

                    <a
                        href="{{ route('chat.create') }}"
                        class="btn btn-primary">

                        Crear mi primer chat

                    </a>

                </div>

            @endforelse

        </div>

    </div>

    <div class="mt-3">

        {{ $chats->links() }}

    </div>

</div>

@endsection