@extends('layouts.app')

@section('title', $activity->name)

@section('content')

<div class="container">

    <div class="row mb-4">

        <div class="col-lg-8">

            <img
                src="{{ $activity->primaryImage?->image_path ?? asset('images/default-activity.jpg') }}"
                class="img-fluid rounded shadow-sm w-100"
                alt="{{ $activity->name }}">

        </div>

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h1 class="section-title mb-3">
                        {{ $activity->name }}
                    </h1>

                    <div class="mb-3">

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

                    <div class="mb-3">

                        <h3 class="mb-1">

                            <i class="bi bi-star-fill text-warning"></i>
                            {{ number_format($averageRating ?? 0, 1) }}


                        </h3>

                        <p class="text-muted mb-0">

                            Basado en {{ $totalReviews }} opiniones

                        </p>

                    </div>

                    <hr>

                    <p class="mb-2">

                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>

                        <strong>
                            {{ $activity->location->city }}
                        </strong>

                    </p>

                    <p class="mb-2">
                        {{ $activity->location->country->name }}
                    </p>

                    <p class="mb-4">
                        {{ $activity->location->street }}
                    </p>

                    @auth

                    <div class="d-flex gap-2">

                        <button
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#addToTripModal">

                            <i class="bi bi-plus-circle-fill me-1"></i>

                            Agregar a mi viaje

                        </button>

                        <button
                            type="button"
                            class="btn btn-outline-danger">

                            <i class="bi bi-heart-fill"></i>

                        </button>

                    </div>

                    @endauth

                </div>

            </div>

        </div>

    </div>

    {{-- Descripción --}}

    <div class="card border-0 shadow-sm mb-5">

        <div class="card-body">

            <h3 class="section-title mb-3">
                Descripción
            </h3>

            <p class="mb-0">
                {{ $activity->description }}
            </p>

        </div>

    </div>

    {{-- Reviews Header --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="section-title mb-0">

            <i class="bi bi-chat-left-text me-2"></i>

            Opiniones

        </h3>

        <form method="GET">

            <select
                name="sort"
                class="form-select"
                onchange="this.form.submit()">

                <option
                    value="best"
                    {{ $sort == 'best' ? 'selected' : '' }}>

                    Mejor valoradas

                </option>

                <option
                    value="worst"
                    {{ $sort == 'worst' ? 'selected' : '' }}>

                    Peor valoradas

                </option>

            </select>

        </form>

    </div>

    {{-- Reviews --}}

    @forelse($reviews as $review)

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start mb-2">

                    <div>

                        <h5 class="fw-bold mb-1">
                            {{ $review->title }}
                        </h5>

                        <small class="text-muted">
                            {{ $review->user->name }}
                        </small>

                    </div>

                    <span class="badge bg-primary">

                        {{ $review->rating }}/5

                    </span>

                </div>

                <div class="mb-2">

                    @for($i = 1; $i <= 5; $i++)

                        @if($i <= $review->rating)

                            <i class="bi bi-star-fill text-warning"></i>

                        @else

                            <i class="bi bi-star text-warning"></i>

                        @endif

                    @endfor

                </div>

                <p class="mb-0">

                    {{ $review->description }}
                </p>
                @if($review->images->count())

                <div class="row mt-3">

                    @foreach($review->images as $image)

                        <div class="col-md-3 col-6 mb-3">

                            <a
                                href="{{ $image->image_path }}"
                                target="_blank">

                                <img
                                    src="{{ $image->image_path }}"
                                    class="img-fluid rounded shadow-sm w-100"
                                    style="
                                        height: 150px;
                                        object-fit: cover;
                                    "
                                    alt="Imagen de reseña">

                            </a>

                        </div>

                    @endforeach

                </div>

            @endif

            </div>

        </div>

    @empty

        <div class="alert alert-info">

            No existen opiniones para esta actividad.

        </div>

    @endforelse

    {{-- Paginación --}}

    @if($reviews->hasPages())

        <div class="d-flex justify-content-center mt-4">

            {{ $reviews->appends([
                'sort' => $sort
            ])->links() }}

        </div>

    @endif
</div>

{{-- MODAL AGREGAR A VIAJE --}}
<div
    class="modal fade"
    id="addToTripModal"
    tabindex="-1"
    aria-labelledby="addToTripModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="addToTripModalLabel">
                    Agregar actividad al viaje
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <form
                action="{{ route('itinerary.activity.store') }}"
                method="POST">

                @csrf

                <div class="modal-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input
                        type="hidden"
                        name="activity_id"
                        value="{{ $activity->activity_id }}">

                    <div class="mb-3">
                        <label class="form-label">
                            Viaje
                        </label>

                        <select
                            id="trip_select"
                            name="itinerary_id"
                            class="form-select"
                            required>

                            <option value="">
                                Seleccione un viaje
                            </option>

                            @foreach ($trips as $trip)
                                @if ($trip->itinerary)
                                    <option
                                        value="{{ $trip->itinerary->itinerary_id }}"
                                        {{ old('itinerary_id') == $trip->itinerary->itinerary_id ? 'selected' : '' }}
                                        data-start="{{ \Carbon\Carbon::parse($trip->start_date)->format('Y-m-d') }}"
                                        data-end="{{ \Carbon\Carbon::parse($trip->end_date)->format('Y-m-d') }}">

                                        {{ $trip->title }}
                                        (
                                        {{ \Carbon\Carbon::parse($trip->start_date)->format('d/m/Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($trip->end_date)->format('d/m/Y') }}
                                        )
                                    </option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Inicio
                        </label>

                        <input
                            type="datetime-local"
                            id="start_time"
                            name="start_time"
                            class="form-control"
                            value="{{ old('start_time') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Fin
                        </label>

                        <input
                            type="datetime-local"
                            id="end_time"
                            name="end_time"
                            class="form-control"
                            value="{{ old('end_time') }}"
                            required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Agregar
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const tripSelect = document.getElementById('trip_select');
    const startInput = document.getElementById('start_time');
    const endInput = document.getElementById('end_time');

    function updateLimits() {

        const option =
            tripSelect.options[
                tripSelect.selectedIndex
            ];

        const start = option?.dataset?.start;
        const end   = option?.dataset?.end;

        if (!start || !end) {
            return;
        }

        startInput.min = start + 'T00:00';
        startInput.max = end + 'T23:59';

        endInput.min = start + 'T00:00';
        endInput.max = end + 'T23:59';
    }

    tripSelect.addEventListener(
        'change',
        updateLimits
    );

    updateLimits();

    @if ($errors->any())

        setTimeout(function () {

            const modalElement =
                document.getElementById(
                    'addToTripModal'
                );

            if (!modalElement) {
                return;
            }

            const modal =
                bootstrap.Modal.getOrCreateInstance(
                    modalElement
                );

            modal.show();

        }, 200);

    @endif

});
</script>

@endsection

