@extends('layouts.app')


@section('title', 'Foros')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">

        <h2>Comparte tus experiencias   </h2>

        <div>
            <a href="{{ route('forum.myForums') }}"
            class="btn btn-warning">
                Mis Foros
            </a>

            <a href="{{ route('forum.create') }}"
            class="btn btn-primary">
                Nuevo Foro
            </a>
        </div>

    </div>

    @foreach($forums as $forum)

        <div class="card mb-3">

            <div class="card-body">

                <h4>
                    <a href="{{ route('forum.show', $forum->forum_id) }}"
                        class="section-title">
                        {{ $forum->title }}
                    </a>
                </h4>

                <p class="text-muted">
                    {{ Str::limit($forum->description, 150) }}
                </p>

                <small>
                    Creado por:
                    {{ $forum->user->name }}
                    {{ $forum->user->last_name }}
                </small>

            </div>

        </div>

    @endforeach

</div>

@endsection