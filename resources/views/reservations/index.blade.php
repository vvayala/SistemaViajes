@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-airplane me-2"></i>
                    Buscar vuelos · {{ $itinerary->name }}
                </div>
                <div class="card-body p-4">

                    @if($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($countries->count() < 2)
                        <div class="alert alert-warning rounded-3">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Necesitas al menos 2 países con IATA en las actividades de este itinerario
                            para poder buscar vuelos.
                        </div>
                    @endif

                    <form action="{{ route('reservations.search') }}" method="POST">
                        @csrf
                        <input type="hidden" name="itinerary_id" value="{{ $itinerary->itinerary_id }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> Origen
                                </label>
                                <select name="origin" class="form-select" required>
                                    <option value="" disabled {{ old('origin') ? '' : 'selected' }}>
                                        Seleccione país de origen
                                    </option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->iata }}"
                                            {{ old('origin') === $country->iata ? 'selected' : '' }}>
                                            {{ $country->name }} ({{ $country->iata }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt-fill text-success me-1"></i> Destino
                                </label>
                                <select name="destination" class="form-select" required>
                                    <option value="" disabled {{ old('destination') ? '' : 'selected' }}>
                                        Seleccione país de destino
                                    </option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->iata }}"
                                            {{ old('destination') === $country->iata ? 'selected' : '' }}>
                                            {{ $country->name }} ({{ $country->iata }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-calendar3 me-1"></i> Fecha de salida
                                </label>
                                <input type="date" name="date" value="{{ old('date') }}"
                                       class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-people me-1"></i> Pasajeros
                                </label>
                                <input type="number" name="passengers" value="{{ old('passengers', 1) }}"
                                       class="form-control" min="1" max="9" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('itinerary.show', $itinerary->itinerary_id) }}"
                               class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i> Volver al itinerario
                            </a>

                            <button type="submit" class="btn btn-primary px-4"
                                    @disabled($countries->count() < 2)>
                                <i class="bi bi-search me-1"></i> Buscar vuelos
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection