@extends('layouts.app')

@section('content')

<div class="container">

    <div class="hero-home mb-4">
        <h1>
            <i class="bi bi-airplane me-2"></i>
            Descubre tu próxima aventura
        </h1>
    </div>

    <form action="{{ route('home') }}" method="GET">

        <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row g-2 align-items-end">

                <div class="col-lg-3 col-md-6">

                    <label class="form-label small fw-semibold">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        País
                    </label>

                    <select
                        name="country_id"
                        class="form-select">

                        <option value="">Todos</option>

                        @foreach($countries as $country)

                            <option
                                value="{{ $country->country_id }}"
                                {{ request('country_id') == $country->country_id ? 'selected' : '' }}>

                                {{ $country->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-3 col-md-6">

                    <label class="form-label small fw-semibold">
                        <i class="bi bi-wallet2 me-1"></i>
                        Presupuesto
                    </label>

                    <select
                        name="budget_type_id"
                        class="form-select">

                        <option value="">Todos</option>

                        @foreach($budgetTypes as $budgetType)

                            <option
                                value="{{ $budgetType->budget_type_id }}"
                                {{ request('budget_type_id') == $budgetType->budget_type_id ? 'selected' : '' }}>

                                {{ $budgetType->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2 col-md-6">

                    <label class="form-label small fw-semibold">
                        <i class="bi bi-airplane-fill me-1"></i>
                        Viaje
                    </label>

                    <select
                        name="trip_type_id"
                        class="form-select">

                        <option value="">Todos</option>

                        @foreach($tripTypes as $tripType)

                            <option
                                value="{{ $tripType->trip_type_id }}"
                                {{ request('trip_type_id') == $tripType->trip_type_id ? 'selected' : '' }}>

                                {{ $tripType->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2 col-md-6">

                    <label class="form-label small fw-semibold">
                        <i class="bi bi-heart-fill me-1"></i>
                        Interés
                    </label>

                    <select
                        name="interest_id"
                        class="form-select">

                        <option value="">Todos</option>

                        @foreach($interests as $interest)

                            <option
                                value="{{ $interest->interest_id }}"
                                {{ request('interest_id') == $interest->interest_id ? 'selected' : '' }}>

                                {{ $interest->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2">

                    <div class="d-grid">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-search me-1"></i>
                            Buscar

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

        <div class="mb-4">

            <button
                type="submit"
                class="btn btn-primary">
                <i class="bi bi-search me-1"></i>
                Buscar Actividades
            </button>

            <a
                href="{{ route('home') }}"
                class="btn btn-outline-secondary">

                <i class="bi bi-arrow-clockwise me-1"></i>
                Limpiar Filtros

            </a>

        </div>

    </form>

    @auth

        @if($recommendedActivities->count())

            <h3 class="recommended-title mb-4">
                <i class="bi bi-stars text-warning me-2"></i>
                Recomendadas para Ti
            </h3>

            <div class="row">

                @foreach($recommendedActivities as $activity)

                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="card activity-card h-100">

                            <img
                                src="{{ $activity->primaryImage?->image_path ?? asset('images/default-activity.jpg') }}"
                                class="card-img-top"
                                alt="{{ $activity->name }}">

                            <div class="card-header">
                                {{ $activity->name }}
                            </div>

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex flex-wrap gap-2">

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

                                @auth

                                @include('activity._actions')

                                @endauth

                            </div>

                                <p class="text-muted">
                                    {{ Str::limit($activity->description, 120) }}
                                </p>

                                <div class="location-box">

                                    <p class="mb-1">
                                        <strong>
                                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                            {{ $activity->location->city }}
                                        </strong>
                                    </p>

                                    <p class="mb-1">
                                        {{ $activity->location->country->name }}
                                    </p>

                                    <p class="mb-0">
                                        {{ $activity->location->street }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    @endauth

    <h3 class="recommended-title {{ Auth::check() && $recommendedActivities->count() ? 'mt-5' : '' }} mb-4">

        @auth
            <i class="bi bi-globe-americas me-2"></i>
            Otras Opciones
        @else
            <i class="bi bi-globe-americas me-2"></i>
            Actividades Disponibles
        @endauth

    </h3>

    <div class="row">

        @forelse($otherActivities as $activity)

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="card activity-card h-100">

                    <img
                        src="{{ $activity->primaryImage?->image_path ?? asset('images/default-activity.jpg') }}"
                        class="card-img-top"
                        alt="{{ $activity->name }}">

                    <div class="card-header">
                        {{ $activity->name }}
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                        <div class="d-flex flex-wrap gap-2">

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

                        @auth
                            @include('activity._actions')
                        @endauth

                    </div>

                        <p class="text-muted">
                            {{ Str::limit($activity->description, 120) }}
                        </p>

                        <div class="location-box">

                            <p class="mb-1">
                                <strong>
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                    {{ $activity->location->city }}
                                </strong>
                            </p>

                            <p class="mb-1">
                                {{ $activity->location->country->name }}
                            </p>

                            <p class="mb-0">
                                {{ $activity->location->street }}
                            </p>

                        </div>
                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info">
                    No se encontraron actividades.
                </div>

            </div>

        @endforelse

    </div>

    @if($otherActivities->hasPages())

    <div class="d-flex justify-content-center gap-2 mt-4">

        @if(!$otherActivities->onFirstPage())
            <a
                href="{{ $otherActivities->previousPageUrl() }}"
                class="btn btn-primary">
                <i class="bi bi-chevron-left"></i>
                Anterior
            </a>
        @endif

        @if($otherActivities->hasMorePages())
            <a
                href="{{ $otherActivities->nextPageUrl() }}"
                class="btn btn-primary">
                Siguiente
                <i class="bi bi-chevron-right"></i>
            </a>
        @endif

    </div>

    @endif



</div>

@endsection