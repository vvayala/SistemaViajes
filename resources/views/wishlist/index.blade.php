@extends('layouts.app')

@section('title', 'Mi Wishlist')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="mb-1">
                <i class="bi bi-heart-fill text-danger me-2"></i>
                Mi Wishlist
            </h1>

            <p class="text-muted mb-0">
                Guarda actividades que te gustaría realizar en el futuro.
            </p>

        </div>

        <a
            href="{{ route('home') }}"
            class="btn btn-primary">

            <i class="bi bi-compass me-2"></i>
            Explorar Actividades

        </a>

    </div>

    @if($wishlist && $wishlist->details->count())

        <div class="row">

            @foreach($wishlist->details as $detail)

                @php
                    $activity = $detail->activity;
                @endphp

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card activity-card h-100 shadow-sm">

                        <img
                            src="{{ $activity->primaryImage?->image_path ?? asset('images/default-activity.jpg') }}"
                            class="card-img-top"
                            alt="{{ $activity->name }}">

                        <div class="card-header fw-bold">
                            {{ $activity->name }}
                        </div>

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-3">

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

                                <div class="d-flex gap-1">

                
                                    <form
                                        action="{{ route('wishlist.destroy', $activity->activity_id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger">

                                            <i class="bi bi-heart-fill"></i>

                                        </button>

                                    </form>

                                    <a href="{{ route('activity.show', $activity->activity_id) }}"
                                        class="btn btn-sm btn-primary px-4">
                                        Ver
                                    </a>

                                </div>

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

    @else

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-heart display-1 text-danger"></i>

                <h3 class="mt-3">
                    Tu wishlist está vacía
                </h3>

                <p class="text-muted">

                    Cuando encuentres actividades interesantes,
                    podrás guardarlas aquí.

                </p>

                <a
                    href="{{ route('home') }}"
                    class="btn btn-primary">

                    <i class="bi bi-compass me-1"></i>
                    Explorar Actividades

                </a>

            </div>

        </div>

    @endif

</div>

@endsection