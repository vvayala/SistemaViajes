@extends('layouts.app')

@section('title', 'Crear reseña')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header">

                    <h4 class="mb-0">
                        Escribir reseña
                    </h4>

                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <h5>
                            {{ $activity->name }}
                        </h5>

                        <p class="text-muted mb-0">
                            {{ $activity->location->country->name }}
                        </p>

                    </div>

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
                        action="{{ route('reviews.store', $activity->activity_id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Calificación
                            </label>

                            <select
                                name="rating"
                                class="form-select"
                                required>

                                <option value="">
                                    Seleccione una calificación
                                </option>

                                @for($i = 5; $i >= 1; $i--)

                                    <option
                                        value="{{ $i }}"
                                        {{ old('rating') == $i ? 'selected' : '' }}>

                                        {{ $i }} estrella{{ $i > 1 ? 's' : '' }}

                                    </option>

                                @endfor

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Título
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ old('title') }}"
                                maxlength="255"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Comentario
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                                required>{{ old('description') }}</textarea>

                        </div>
                        <div class="mb-3">

                                <label class="form-label">
                                    Fotos
                                </label>

                                <input
                                    type="file"
                                    name="images[]"
                                    class="form-control"
                                    accept="image/*"
                                    multiple>

                            </div>

                        <div class="d-flex gap-2">

                            

                            <button
                                type="submit"
                                class="btn btn-primary">

                                Publicar reseña

                            </button>

                            <a
                                href="{{ url()->previous() }}"
                                class="btn btn-secondary">

                                Cancelar

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection