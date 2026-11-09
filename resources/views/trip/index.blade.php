@extends('layouts.app')

@section('title', 'Mis viajes')

@section('content')

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mb-4">

        <h2>Mis Viajes</h2>

        <a href="{{ route('trip.create') }}"
           class="btn btn-primary">
            Nuevo Viaje
        </a>

    </div>

    @forelse($trips as $trip)

        <div class="card mb-3">

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">

                <div class="flex-grow-1">

                    <h4 class="mb-2">
                        <a
                            href="{{ route('trip.show', $trip->trip_id) }}"
                            class="section-title">
                            {{ $trip->title }}
                        </a>
                    </h4>

                    <span class="badge bg-secondary mb-2">
                        {{ $trip->tripType->name }}
                    </span>

                    <p class="text-muted mb-2">
                        {{ Str::limit($trip->description, 150) }}
                    </p>

                    <small class="text-muted">
                        <i class="bi bi-calendar-event me-1"></i>
                        Del {{ $trip->start_date }}
                        al {{ $trip->end_date }}
                    </small>

                </div>

                <div class="d-flex flex-wrap gap-2 ms-3">

                    <a
                        href="{{ route('itinerary.index', $trip->trip_id) }}"
                        class="btn btn-primary btn-sm">

                        <i class="bi bi-map me-1"></i>
                        Itinerario

                    </a>

                    <a
                        href="{{ route('reservation.index', $trip->trip_id) }}"
                        class="btn btn-primary btn-sm">

                        <i class="bi bi-calendar-check me-1"></i>
                        Reservas

                    </a>

                    <a
                        href="{{ route('trip.edit', $trip->trip_id) }}"
                        class="btn btn-primary btn-sm">

                        <i class="bi bi-pencil-fill me-1"></i>
                        Editar

                    </a>

                    <form
                        action="{{ route('trip.destroy', $trip->trip_id) }}"
                        method="POST"
                        onsubmit="return confirm('¿Desea eliminar este viaje?')">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm">

                            <i class="bi bi-trash-fill me-1"></i>
                            Eliminar

                        </button>

                    </form>

                </div>

            </div>

            </div>

        </div>

    @empty

        <div class="alert alert-info">
            No has registrado viajes todavía.
        </div>

    @endforelse

</div>

@endsection