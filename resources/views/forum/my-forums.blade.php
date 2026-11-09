@extends('layouts.app')

@section('title', 'Mis Foros')

@section('content')

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Mis Foros</h2>

        <div>
            <a href="{{ route('forum.index') }}"
               class="btn btn-primary">
                Todos los Foros
            </a>

            <a href="{{ route('forum.create') }}"
               class="btn btn-primary">
                Nuevo Foro
            </a>
        </div>

    </div>

    @forelse($forums as $forum)

        <div class="card mb-3">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <h4>
                            <a href="{{ route('forum.show', $forum->forum_id) }}"
                               class="section-title">
                                {{ $forum->title }}
                            </a>
                        </h4>

                        <p class="text-muted">
                            {{ Str::limit($forum->description, 150) }}
                        </p>

                        <small class="text-secondary">
                            Creado por:
                            {{ $forum->user->name }}
                            {{ $forum->user->last_name }}
                        </small>

                    </div>

                    <div class="ms-3">

                        <form action="{{ route('forum.destroy', $forum->forum_id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Deseas eliminar este foro?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger">
                                Eliminar
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-info">
            Aún no has creado ningún foro.
        </div>

    @endforelse

</div>

@endsection