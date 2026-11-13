@extends('layouts.app')

@section('title', 'Nueva Reserva')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h3 class="mb-0">
                        <i class="bi bi-calendar-check me-2"></i>
                        Nueva Reserva
                    </h3>

                </div>

                <div class="card-body">

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form
                        action="{{ route('reservation.store') }}"
                        method="POST">

                        @csrf

                        <input
                            type="hidden"
                            name="trip_id"
                            value="{{ $trip->trip_id }}">

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Tipo de Reserva
                                </label>

                                <select
                                    name="reservation_type_id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Seleccionar
                                    </option>

                                    @foreach($reservationTypes as $type)

                                        <option
                                            value="{{ $type->reservation_type_id }}"
                                            {{ old('reservation_type_id') == $type->reservation_type_id ? 'selected' : '' }}>

                                            {{ $type->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Actividad Asociada
                                </label>

                                <select
                                    name="activity_id"
                                    class="form-select">

                                    <option value="">
                                        Sin actividad asociada
                                    </option>

                                    @foreach($activities as $activity)

                                        <option
                                            value="{{ $activity->activity_id }}"
                                            {{ old('activity_id') == $activity->activity_id ? 'selected' : '' }}>

                                            {{ $activity->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Precio
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="price"
                                    class="form-control"
                                    value="{{ old('price') }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Cantidad
                                </label>

                                <input
                                    type="number"
                                    min="1"
                                    name="quantity"
                                    class="form-control"
                                    value="{{ old('quantity', 1) }}"
                                    required>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Descripción
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="form-control">{{ old('description') }}</textarea>

                        </div>

                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('reservation.index', $trip->trip_id) }}"
                                class="btn btn-outline-secondary">

                                Cancelar

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-floppy-fill me-1"></i>
                                Guardar Reserva

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection