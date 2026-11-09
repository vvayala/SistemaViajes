@extends('layouts.app')

@section('title', 'Itinerarios')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-4">

        <h2>
            Itinerarios
        </h2>

        @if($itineraries->isEmpty())

            <a
                href="{{ route('itinerary.create', $trip->trip_id) }}"
                class="btn btn-primary">

                Nuevo Itinerario

            </a>

        @endif

    </div>

    @foreach($itineraries as $itinerary)

    <div class="card mb-3">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start">

                <div>

                    <h4>

                        <a
                            class="section-title"
                            href="{{ route('itinerary.show', $itinerary->itinerary_id) }}">

                            {{ $itinerary->name }}

                        </a>

                    </h4>

                    <p class="mb-0">

                        {{ $itinerary->description }}

                    </p>

                </div>

                <div class="d-flex gap-2">
                    <a
                        href="{{ route('itinerary.edit', $itinerary->itinerary_id) }}"
                        class="btn btn-sm btn-primary">

                        <i class="bi bi-pencil-fill me-1"></i>
                        Editar

                    </a>

                    <form
                        action="{{ route('itinerary.destroy', $itinerary->itinerary_id) }}"
                        method="POST"
                        onsubmit="return confirm('¿Desea eliminar este itinerario?')">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-sm btn-danger">

                            <i class="bi bi-trash-fill me-1"></i>
                            Eliminar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endforeach

    
</div>

@endsection