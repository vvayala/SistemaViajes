@extends('layouts.app')

@section('title', 'Foro - ' . $forum->title)

@section('content')

<div class="container">
    
    <a href="{{ route('forum.index') }}" class="btn btn-primary mb-3">
        Volver
    </a>

    <div class="card mb-4">

    

        <div class="card-header">
            {{ $forum->title }}
        </div>

        <div class="card-body">

            <p>
                {{ $forum->description }}
            </p>

            <hr>

            @if($forum->images->count())

            <div class="row mt-3">

            @foreach($forum->images as $image)

                <div class="col-md-3 col-6 mb-3">

                    <a
                        href="{{ $image->image_path }}"
                        target="_blank">

                        <img
                            src="{{ $image->image_path }}"
                            class="img-fluid rounded shadow-sm w-100"
                            style="
                                height: 180px;
                                object-fit: cover;
                            ">

                    </a>

                </div>

            @endforeach

        </div>

    @endif

            <small>
                Publicado por
                {{ $forum->user->name }}
                {{ $forum->user->last_name }}
            </small>

        </div>

    </div>

    <div class="card mb-4">

        <div class="card-header">
            Responder
        </div>

        <div class="card-body">

            <form
                action="{{ route('forum.participation.store') }}"
                method="POST">

                @csrf

                <input type="hidden"
                    name="forum_id"
                    value="{{ $forum->forum_id }}">

                <textarea
                    name="comment"
                    class="form-control mb-3"
                    rows="4"
                    placeholder="Escribe tu respuesta"></textarea>

                <button
                    type="submit"
                    class="btn btn-primary">
                    Publicar Respuesta
                </button>

            </form>

        </div>

    </div>

    <div class="card-body">
        </div>

        <div class="card-body">

            @forelse($forum->participations as $participation)

                <div class="border rounded p-3 mb-3">

                    <h6>
                        {{ $participation->user->name }}
                        {{ $participation->user->last_name}}
                    </h6>

                    <p class="mb-0">
                        {{ $participation->comment}}
                    </p>

                </div>

            @empty

                <p>
                    No hay respuestas todavía.
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection