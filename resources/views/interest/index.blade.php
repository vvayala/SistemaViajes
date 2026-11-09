@extends('layouts.app')

@section('title', 'Mis intereses')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow-sm">

                <div class="card-header text-center">
                    <h4 class="mb-0 fw-bold">
                        ¿Qué te interesa?
                    </h4>
                </div>

                <div class="card-body">

                    <div class="text-center mb-4">
                        <p class="text-muted mb-0">
                            Selecciona uno o varios intereses para recibir
                            recomendaciones personalizadas de destinos,
                            actividades y viajes.
                        </p>
                    </div>

                    <form method="POST"
                          action="{{ route('interests.store') }}">

                        @csrf

                        <div class="row">
                            <div class="row">

                        @foreach($interests as $interest)

                            <div class="col-6 col-md-4 col-lg-2 mb-3">

                                <input
                                    type="checkbox"
                                    class="btn-check"
                                    name="interests[]"
                                    value="{{ $interest->interest_id }}"
                                    id="interest{{ $interest->interest_id }}"
                                    autocomplete="off"

                                    {{ in_array(
                                        $interest->interest_id,
                                        $selectedInterests
                                    ) ? 'checked' : '' }}
                                >

                                <label
                                    class="card interest-card h-100"
                                    for="interest{{ $interest->interest_id }}">

                                    <div class="card-body text-center py-3">

                                        <span class="fw-semibold">
                                            {{ $interest->name }}
                                        </span>

                                    </div>

                                </label>

                            </div>

                        @endforeach

                    </div>

                            

                        </div>

                        @error('interests')

                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>

                        @enderror

                        <div class="text-center mt-4">

                            <button
                                type="submit"
                                class="btn btn-primary px-5 py-2 fw-semibold"
                                href="{{ route('home') }}">
                                Inicio

                            </button>

                            <button
                                type="submit"
                                class="btn btn-primary px-5 py-2 fw-semibold">

                                Guardar intereses

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection