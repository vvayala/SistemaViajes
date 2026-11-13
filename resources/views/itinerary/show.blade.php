@extends('layouts.app')

@section('title', $itinerary->name)

@section('content')

<div class="container">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- CABECERA --}}

    <a href="{{ route('trip.index')}}"
        class="btn btn-primary btn-sm mb-2">
        Volver
    </a>

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start">

                <div>

                    <h2 class="section-title">

                        {{ $itinerary->name }}

                    </h2>

                    <p class="text-muted">

                        {{ $itinerary->description }}

                    </p>

                    <span class="badge bg-primary">

                        {{ $scheduledActivities->count() }}
                        actividades programadas

                    </span>

                   <div class="mt-3 d-flex gap-2 flex-wrap">
                        <a href="{{ route('reservations.my', $itinerary->itinerary_id) }}"
                        class="btn btn-warning btn-sm fw-bold">
                            <i class="bi bi-ticket-perforated me-1"></i> Mis reservas
                        </a>

                        <a href="{{ route('reservations.index', $itinerary->itinerary_id) }}"
                        class="btn btn-primary btn-sm">
                            <i class="bi bi-airplane me-1"></i> Nueva reserva
                        </a>
                    </div>
                </div>
        </div>

    </div>

    {{-- FECHAS VIAJE --}}

    <div class="alert alert-info">

        <strong>
            Viaje:
        </strong>

        {{ \Carbon\Carbon::parse(
            $itinerary->trip->start_date
        )->format('d/m/Y') }}

        —

        {{ \Carbon\Carbon::parse(
            $itinerary->trip->end_date
        )->format('d/m/Y') }}

    </div>

    {{-- CRONOGRAMA --}}

    @php

        $groupedActivities = $scheduledActivities
            ->groupBy(function ($activity) {

                return \Carbon\Carbon::parse(
                    $activity->pivot->start_time
                )->format('Y-m-d');

            });

    @endphp

    <div class="card shadow-sm mb-5">

        <div class="card-header">

            <h4 class="mb-0">

                <i class="bi bi-calendar-event me-2"></i>

                Cronograma

            </h4>

        </div>

        <div class="card-body">

            @forelse($groupedActivities as $date => $dayActivities)

                <h5 class="mb-3">

                    {{ \Carbon\Carbon::parse($date)
                        ->format('d/m/Y') }}

                </h5>

                @foreach($dayActivities as $activity)

                    <div
                        class="border-start border-4 border-primary ps-3 mb-4">

                        <strong>

                            {{ \Carbon\Carbon::parse(
                                $activity->pivot->start_time
                            )->format('H:i') }}

                            -

                            {{ \Carbon\Carbon::parse(
                                $activity->pivot->end_time
                            )->format('H:i') }}

                        </strong>

                        <div class="mt-1 mb-2">

                            <strong>

                                {{ $activity->name }}

                            </strong>


                        </div>

                        <div class="mb-2">

                            @if($activity->tripType)

                                <span class="activity-badge">

                                    {{ $activity->tripType->name }}

                                </span>

                            @endif

                            @if($activity->interest)

                                <span class="activity-badge">

                                    {{ $activity->interest->name }}

                                </span>

                            @endif

                            @if($activity->budgetType)

                                <span class="activity-badge">

                                    {{ $activity->budgetType->name }}

                                </span>

                            @endif

                        </div>

                        <small class="text-muted">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                            {{ $activity->location->country->name }}

                        </small>

                        <div class="my-2">

                            @if($activity->season_name == 'Alta')

                                <span class="badge bg-danger">

                                     Temporada Alta

                                </span>

                            @elseif($activity->season_name == 'Media')

                                <span class="badge bg-warning text-dark">

                                     Temporada Media

                                </span>

                            @else

                                <span class="badge bg-success">

                                     Temporada Baja

                                </span>

                            @endif

                        </div>

                        <form
                            action="{{ route(
                                'itinerary.activity.destroy',
                                $activity->pivot->itinerary_activity_id
                            ) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-sm btn-outline-danger">

                                Quitar

                            </button>

                            @php
                                $alreadyReviewed = \App\Models\ActivityReview::where(
                                    'activity_id',
                                    $activity->activity_id
                                )
                                ->where(
                                    'user_id',
                                    auth()->id()
                                )
                                ->exists();
                            @endphp

                            @if(!$alreadyReviewed)

                                <a
                                    href="{{ route(
                                        'reviews.create',
                                        $activity->activity_id
                                    ) }}"
                                    class="btn btn-sm btn-outline-primary">

                                    Escribir reseña

                                </a>

                            @else

                                <span class="badge bg-success">
                                    Reseñada
                                </span>

                            @endif

                        </form>

                    </div>

                @endforeach

            @empty

                <div class="alert alert-warning">

                    No hay actividades programadas.

                </div>

            @endforelse

        </div>

    </div>

    {{-- FILTROS --}}

    <div class="card shadow-sm mb-4">

        <div class="card-header">

            <h5 class="mb-0">

                Actividades Disponibles

            </h5>

        </div>

        <div class="card-body">

            <form method="GET">

                <div class="row g-2">

                    <div class="col-md-4">

                        <label class="form-label small fw-semibold">
                            <i class="bi bi-geo-alt-fill me-1"></i>
                            País
                        </label>

                        <select
                            name="country_id"
                            class="form-select">

                            <option value="">
                                Todos los países
                            </option>

                            @foreach($countries as $country)

                                <option
                                    value="{{ $country->country_id }}"
                                    {{ request('country_id') == $country->country_id ? 'selected' : '' }}>

                                    {{ $country->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4">

                    <label class="form-label small fw-semibold">
                        <i class="bi bi-wallet2 me-1"></i>
                        Presupuesto
                    </label>

                        <select
                            name="budget_type_id"
                            class="form-select">

                            <option value="">
                                Todos los presupuestos
                            </option>

                            @foreach($budgetTypes as $budget)

                                <option
                                    value="{{ $budget->budget_type_id }}"
                                    {{ request('budget_type_id') == $budget->budget_type_id ? 'selected' : '' }}>

                                    {{ $budget->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <label class="form-label small fw-semibold">
                            <i class="bi bi-calendar3 me-1"></i>
                            Temporada
                        </label>

                        <select
                            name="season"
                            class="form-select">

                            <option value="">
                                Todas

                            </option>

                            <option
                                value="Alta"
                                {{ request('season') == 'Alta' ? 'selected' : '' }}>

                                Alta

                            </option>

                            <option
                                value="Media"
                                {{ request('season') == 'Media' ? 'selected' : '' }}>

                                Media

                            </option>

                            <option
                                value="Baja"
                                {{ request('season') == 'Baja' ? 'selected' : '' }}>

                                Baja

                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button
                            class="btn btn-primary w-100 mb-2">

                            Filtrar

                        </button>

                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-100">
                            Limpiar
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- ACTIVIDADES --}}

    <div class="row">

        @forelse($activities as $activity)

            @php

                $alreadyAdded = $scheduledActivities
                    ->contains(
                        fn ($scheduled) =>
                            $scheduled->activity_id
                            ==
                            $activity->activity_id
                    );

            @endphp

            <div class="col-lg-4 mb-4">

                <div class="card h-100">

                    <img
                        src="{{ $activity->primaryImage?->image_path ?? asset('images/default-activity.jpg') }}"
                        class="card-img-top">

                    <div class="card-body">

                        <h5>

                            {{ $activity->name }}

                        </h5>

                        <div class="mb-2">

    @if($activity->tripType)

        <span class="activity-badge">

            {{ $activity->tripType->name }}

        </span>

    @endif

    @if($activity->interest)

        <span class="activity-badge">

            {{ $activity->interest->name }}

        </span>

    @endif

        @if($activity->budgetType)

            <span class="activity-badge">

                {{ $activity->budgetType->name }}

            </span>

        @endif

    </div>

                        <p class="text-muted">

                            {{ Str::limit(
                                $activity->description,
                                120
                            ) }}

                        </p>

                        <p class="small">

                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                            {{ $activity->location->country->name }}

                        </p>

                        <div class="mb-2">

                            @if($activity->season_name == 'Alta')

                                <span class="badge bg-danger">

                                     Alta

                                </span>

                            @elseif($activity->season_name == 'Media')

                                <span class="badge bg-warning text-dark">

                                     Media

                                </span>

                            @else

                                <span class="badge bg-success">

                                     Baja

                                </span>

                            @endif

                        </div>

                        @if($alreadyAdded)

                            <div class="alert alert-success py-2 text-center">

                                Ya agregada al itinerario

                            </div>

                        @endif

                        <form
                            action="{{ route(
                                'itinerary.activity.store'
                            ) }}"
                            method="POST">

                            @csrf

                            <input
                                type="hidden"
                                name="itinerary_id"
                                value="{{ $itinerary->itinerary_id }}">

                            <input
                                type="hidden"
                                name="activity_id"
                                value="{{ $activity->activity_id }}">

                            <div class="mb-2">

                                <input
                                    type="datetime-local"
                                    name="start_time"
                                    class="form-control"
                                    min="{{ \Carbon\Carbon::parse($itinerary->trip->start_date)->format('Y-m-d\T00:00') }}"
                                    max="{{ \Carbon\Carbon::parse($itinerary->trip->end_date)->format('Y-m-d\T23:59') }}"
                                    {{ $alreadyAdded ? 'disabled' : '' }}
                                    required>

                            </div>

                            <div class="mb-3">

                                <input
                                    type="datetime-local"
                                    name="end_time"
                                    class="form-control"
                                    min="{{ \Carbon\Carbon::parse($itinerary->trip->start_date)->format('Y-m-d\T00:00') }}"
                                    max="{{ \Carbon\Carbon::parse($itinerary->trip->end_date)->format('Y-m-d\T23:59') }}"
                                    {{ $alreadyAdded ? 'disabled' : '' }}
                                    required>

                            </div>

                            <button
                                class="btn btn-primary w-100"
                                {{ $alreadyAdded ? 'disabled' : '' }}>

                                Agregar

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    No hay actividades para los filtros seleccionados.

                </div>

            </div>

        @endforelse

    </div>
</div>

@endsection