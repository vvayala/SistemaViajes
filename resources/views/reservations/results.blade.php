@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="section-title mb-4">
        <i class="bi bi-airplane-engines me-2"></i>
        {{ $validated['origin'] }} → {{ $validated['destination'] }}
    </h2>

    <div class="location-box mb-4">
        <i class="bi bi-calendar-event me-2"></i>
        {{ \Carbon\Carbon::parse($validated['date'])->format('d/m/Y') }}
        &nbsp;·&nbsp;
        <i class="bi bi-people me-2"></i>
        {{ $validated['passengers'] }} pasajero(s)
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    @if(empty($flights))
        <div class="card">
            <div class="card-body p-4 text-center text-muted">
                <i class="bi bi-emoji-frown fs-3 d-block mb-2"></i>
                No se encontraron vuelos para esos parámetros.
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Aerolínea</th>
                                <th>Vuelo</th>
                                <th>Salida</th>
                                <th>Llegada</th>
                                <th class="text-center">Escalas</th>
                                <th class="text-end">Precio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($flights as $flight)
                                @php
                                    $itinerary = $flight['itineraries'][0] ?? null;
                                    $segments  = $itinerary['segments'] ?? [];
                                    $first     = $segments[0] ?? null;
                                    $last      = $segments[count($segments) - 1] ?? null;

                                    $airline   = $flight['validatingAirlineCodes'][0]
                                                 ?? ($flight['googleFlights']['airlines'][0]['code'] ?? 'N/A');
                                    $flightNo  = $first['number'] ?? ($flight['id'] ?? '');
                                    $departure = $first['departure']['at'] ?? null;
                                    $arrival   = $last['arrival']['at']    ?? null;
                                    $price     = $flight['price']['grandTotal'] ?? ($flight['price']['total'] ?? 0);
                                    $currency  = $flight['price']['currency']   ?? 'USD';
                                    $stops     = $flight['googleFlights']['stops'] ?? max(0, count($segments) - 1);
                                    $googleUrl = $flight['googleFlights']['url'] ?? null;
                                @endphp
                                <tr>
                                    <td class="fw-semibold">{{ $airline }}</td>
                                    <td class="text-muted">{{ $flightNo }}</td>
                                    <td>{{ $departure ? \Carbon\Carbon::parse($departure)->format('d/m/Y H:i') : 'N/A' }}</td>
                                    <td>{{ $arrival ? \Carbon\Carbon::parse($arrival)->format('d/m/Y H:i') : 'N/A' }}</td>
                                    <td class="text-center">
                                        @if($stops == 0)
                                            <span class="badge badge-high rounded-pill">Directo</span>
                                        @else
                                            <span class="badge badge-medium rounded-pill">{{ $stops }} escala(s)</span>
                                        @endif
                                    </td>
                                    <td class="text-end fw-bold text-primary">
                                        {{ number_format((float) $price, 2) }} {{ $currency }}
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex flex-column gap-1 align-items-end">
                                            @if($googleUrl)
                                                <a href="{{ $googleUrl }}" target="_blank" rel="noopener"
                                                   class="btn btn-outline-secondary btn-sm">
                                                    <i class="bi bi-box-arrow-up-right me-1"></i> Ver
                                                </a>
                                            @endif
                                            <form action="{{ route('reservations.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="itinerary_id"   value="{{ $validated['itinerary_id'] }}">
                                                <input type="hidden" name="origin"         value="{{ $validated['origin'] }}">
                                                <input type="hidden" name="destination"    value="{{ $validated['destination'] }}">
                                                <input type="hidden" name="departure_time" value="{{ $departure }}">
                                                <input type="hidden" name="arrival_time"   value="{{ $arrival }}">
                                                <input type="hidden" name="airline"        value="{{ $airline }}">
                                                <input type="hidden" name="flight_number"  value="{{ $flightNo }}">
                                                <input type="hidden" name="price"          value="{{ (float) $price }}">
                                                <input type="hidden" name="currency"       value="{{ $currency }}">
                                                <input type="hidden" name="passengers"     value="{{ $validated['passengers'] }}">
                                                <input type="hidden" name="stops"          value="{{ $stops }}">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-check2-circle me-1"></i> Reservar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('reservations.index', $validated['itinerary_id']) }}"
           class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i> Nueva búsqueda
        </a>
        <a href="{{ route('reservations.my', $validated['itinerary_id']) }}"
           class="btn btn-primary">
            <i class="bi bi-ticket-perforated me-1"></i> Mis reservas
        </a>
    </div>

</div>
@endsection