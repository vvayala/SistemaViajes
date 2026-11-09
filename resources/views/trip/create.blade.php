@extends('layouts.app')

@section('title', 'Crear Viaje')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            Crear Viaje
        </div>

        <div class="card-body">

            <form action="{{ route('trip.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Título
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="form-control"
                              required>{{ old('description') }}</textarea>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">
                            Fecha Inicio
                        </label>

                        <input type="date"
                               name="start_date"
                               class="form-control"
                               value="{{ old('start_date') }}"
                               min="{{ now()->toDateString() }}"
                               required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Fecha Fin
                        </label>

                        <input
                            type="date"
                            name="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') }}"
                            required>

                        @error('end_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="mt-3">

                    <label class="form-label">
                        Número de Personas
                    </label>

                    <input type="number"
                           min="1"
                           name="number_of_people"
                           class="form-control"
                     e') }}"
                           required>

                </div>

                <div class="mt-3">

                    <label class="form-label">
                        Tipo de Viaje
                    </label>

                    <select name="trip_type_id"
                            class="form-select"
                            required>

                        <option value="">
                            Seleccione una opción
                        </option>

                        @foreach($tripTypes as $tripType)

                            <option value="{{ $tripType->trip_type_id }}">
                                {{ $tripType->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mt-4">

                    <button type="submit"
                            class="btn btn-primary">
                        Guardar Viaje
                    </button>

                        <a href="{{ route('trip.index') }}"
                       class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection