@extends('layouts.app')

@section('title', 'Centro de Soporte')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="section-title mb-0">

            <i class="bi bi-headset me-2"></i>
            Centro de Soporte

        </h2>

        <span class="badge bg-primary">

            {{ $chats->total() }} chats

        </span>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            @forelse($chats as $chat)

                @php

                    $pendingMessages =
                        $chat->messages
                        ->where('is_read', false)
                        ->where(
                            'sender_id',
                            '!=',
                            auth()->user()->user_id
                        )
                        ->count();

                @endphp

                <div class="border-bottom p-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <h5 class="mb-1">

                                {{ $chat->title }}

                            </h5>

                            <p class="text-muted mb-1">

                                {{ $chat->description }}

                            </p>

                            <small class="text-secondary">

                                <i class="bi bi-person-fill me-1"></i>

                                {{ $chat->user->name }}

                            </small>

                        </div>

                        <div class="text-end">

                            @if($pendingMessages > 0)

                                <span
                                    class="badge bg-danger">

                                    {{ $pendingMessages }}
                                    pendientes

                                </span>

                            @else

                                <span
                                    class="badge bg-success">

                                    Revisado

                                </span>

                            @endif

                            <br>

                            <small
                                class="text-muted">

                                {{ $chat->messages->count() }}
                                mensajes

                            </small>

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

                <div class="p-5 text-center">

                    <i
                        class="bi bi-headset fs-1 text-muted">
                    </i>

                    <p class="mt-3 mb-0">

                        No existen chats de soporte.

                    </p>

                </div>

            @endforelse

        </div>

    </div>

    <div class="mt-3">

        {{ $chats->links() }}

    </div>

</div>

@endsection