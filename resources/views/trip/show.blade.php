@extends('layouts.app')

@section('title', 'Viaje - ' . $trip->title)

@section('content')

<div class="container">

      <a href="{{ route('trip.index') }}"
       class="btn btn-primary mb-3">
        Volver
    </a>

    <div class="card">

        <div class="card-header">
            {{ $trip->title }}
        </div>

        <div class="card-body">

            <div class="mb-4">

                <h5>Descripción</h5>

                <p>
                    {{ $trip->description }}
                </p>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>Fecha de Inicio</strong>

                    <div>
                        {{ $trip->start_date }}
                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Fecha de Finalización</strong>

                    <div>
                        {{ $trip->end_date }}
                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Número de Personas</strong>

                    <div>
                        {{ $trip->number_of_people }}
                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Tipo de Viaje</strong>

                    <div>
                        {{ $trip->tripType->name }}
                    </div>

                </div>

                <div class="col-md-12 mt-3">

                    <strong>Creado por</strong>

                    <div>
                        {{ $trip->user->name }}
                        {{ $trip->user->last_name }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection