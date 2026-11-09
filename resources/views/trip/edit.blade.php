@extends('layouts.app')

@section('title', 'Editar Viaje')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h3 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Editar Viaje
                    </h3>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('trip.update', $trip->trip_id) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">
                                Título
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ old('title', $trip->title) }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Descripción
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="form-control"
                                required>{{ old('description', $trip->description) }}</textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Fecha de Inicio
                                </label>

                                <input
                                    type="date"
                                    name="start_date"
                                    class="form-control"
                                    value="{{ old('start_date', $trip->start_date) }}"
                                    min="{{ now()->toDateString() }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Fecha de Fin
                                </label>

                                <input
                                    type="date"
                                    name="end_date"
                                    class="form-control @error('end_date') is-invalid @enderror"
                                    value="{{ old('end_date', $trip->end_date) }}"
                                    required>

                                @error('end_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Número de Personas
                                </label>

                                <input
                                    type="number"
                                    name="number_of_people"
                                    min="1"
                                    class="form-control"
                                    value="{{ old('number_of_people', $trip->number_of_people) }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Tipo de Viaje
                                </label>

                                <select
                                    name="trip_type_id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Seleccionar
                                    </option>

                                    @foreach($tripTypes as $tripType)

                                        <option
                                            value="{{ $tripType->trip_type_id }}"
                                            {{ old('trip_type_id', $trip->trip_type_id) == $tripType->trip_type_id ? 'selected' : '' }}>

                                            {{ $tripType->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">

                            <a
                                href="{{ route('trip.index') }}"
                                class="btn btn-outline-secondary">

                                <i class="bi bi-arrow-left me-1"></i>
                                Cancelar

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-check-circle-fill me-1"></i>
                                Guardar Cambios

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection