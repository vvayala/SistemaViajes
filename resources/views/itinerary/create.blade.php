@extends('layouts.app')

@section('title', 'Nuevo Itinerario')

@section('content')

<div class="container">

    <form
        action="{{ route('itinerary.store') }}"
        method="POST">

        @csrf

        <input
            type="hidden"
            name="trip_id"
            value="{{ $trip->trip_id }}">

        <div class="mb-3">

            <label>
                Nombre
            </label>

            <input
                name="name"
                class="form-control">

        </div>

        <div class="mb-3">

            <label>
                Descripción
            </label>

            <textarea
                name="description"
                class="form-control">
            </textarea>

        </div>

        <button
            class="btn btn-primary">

            Guardar

        </button>

    </form>

</div>

@endsection