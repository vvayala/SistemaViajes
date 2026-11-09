@extends('layouts.app')

@section('title', 'Editar Itinerario')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h3 class="mb-0">

                        <i class="bi bi-pencil-square me-2"></i>

                        Editar Itinerario

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
                        action="{{ route('itinerary.update', $itinerary->itinerary_id) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">

                                Nombre

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $itinerary->name) }}"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Descripción

                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control"
                                required>{{ old('description', $itinerary->description) }}</textarea>

                        </div>

                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('itinerary.show', $itinerary->itinerary_id) }}"
                                class="btn btn-outline-secondary">

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