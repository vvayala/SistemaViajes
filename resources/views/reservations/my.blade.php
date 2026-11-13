@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="section-title mb-0">
            <i class="bi bi-ticket-perforated me-2"></i> Mis reservas
        </h2>
        <p class="text-muted small mb-0 mt-1">
            <i class="bi bi-map me-1"></i> {{ $itinerary->name }}
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    @forelse($reservations as $reservation)
        <div class="card activity-card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="bi bi-airplane me-2"></i>
                    {{ $reservation->origin }} → {{ $reservation->destination }}
                </span>
                <span class="activity-badge">
                    {{ ucfirst($reservation->status) }}
                </span>
            </div>

            <div class="card-body p-4">
                <div class="location-box mb-3">
                    <i class="bi bi-calendar-event me-2"></i>
                    {{ \Carbon\Carbon::parse($reservation->departure_time)->format('d/m/Y H:i') }}
                    &nbsp;→&nbsp;
                    {{ \Carbon\Carbon::parse($reservation->arrival_time)->format('d/m/Y H:i') }}
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-md-6">
                        <i class="bi bi-building me-1"></i>
                        <strong>Aerolínea:</strong> {{ $reservation->airline ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <i class="bi bi-hash me-1"></i>
                        <strong>Vuelo:</strong> {{ $reservation->flight_number ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <i class="bi bi-people me-1"></i>
                        <strong>Pasajeros:</strong> {{ $reservation->passengers }}
                    </div>
                    <div class="col-md-6">
                        <i class="bi bi-signpost-split me-1"></i>
                        <strong>Escalas:</strong> {{ $reservation->stops }}
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-primary fs-5">
                        {{ number_format((float) $reservation->price, 2) }} {{ $reservation->currency }}
                    </span>

                    @if($reservation->status !== 'cancelled')
                        <form action="{{ route('reservations.cancel', $reservation->reservation_id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-x-circle me-1"></i> Cancelar reserva
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body p-4 text-center text-muted">
                <i class="bi bi-ticket-detailed fs-3 d-block mb-2"></i>
                No tienes reservas todavía para este itinerario.
            </div>
        </div>
    @endforelse

    <div class="mt-4">
        <a href="{{ route('itinerary.show', $itinerary->itinerary_id) }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i> Volver al itinerario
        </a>
    </div>

</div>
@endsection