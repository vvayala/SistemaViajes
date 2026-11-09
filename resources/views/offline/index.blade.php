@extends('layouts.app')

@section('title', 'Modo Offline')

@section('content')

<div class="container">

    <h1 class="mb-4">
        <i class="bi bi-wifi-off text-danger"></i>
        Modo Offline
    </h1>

    <div class="alert alert-warning">
        No tienes conexión a internet. Aquí tienes información útil para tu viaje.
    </div>

    <div class="row">

        <div class="col-md-6 mb-4">

            <div class="card h-100">

                <div class="card-body">

                    <h5>
                        <i class="bi bi-shield-check"></i>
                        Seguridad
                    </h5>

                    <ul>
                        <li>Guarda copias de tus documentos.</li>
                        <li>Evita zonas poco iluminadas por la noche.</li>
                        <li>Comparte tu ubicación con familiares.</li>
                    </ul>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card h-100">

                <div class="card-body">

                    <h5>
                        <i class="bi bi-cash-coin"></i>
                        Presupuesto
                    </h5>

                    <ul>
                        <li>Mantén dinero de emergencia.</li>
                        <li>Usa tarjetas internacionales.</li>
                        <li>Evita cambiar dinero en lugares no autorizados.</li>
                    </ul>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card h-100">

                <div class="card-body">

                    <h5>
                        <i class="bi bi-briefcase"></i>
                        Equipaje
                    </h5>

                    <ul>
                        <li>Lleva cargador portátil.</li>
                        <li>Empaca medicamentos esenciales.</li>
                        <li>Guarda documentos en formato PDF.</li>
                    </ul>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card h-100">

                <div class="card-body">

                    <h5>
                        <i class="bi bi-telephone-fill"></i>
                        Emergencias
                    </h5>

                    <ul>
                        <li>Conoce el número local de emergencias.</li>
                        <li>Ubica hospitales cercanos.</li>
                        <li>Ten el contacto de tu embajada.</li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection