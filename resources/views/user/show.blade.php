@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    Mi Perfil
                </div>

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                             style="width:100px;height:100px;font-size:40px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <h3 class="mt-3 mb-1">
                            {{ $user->name }} {{ $user->last_name }}
                        </h3>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="fw-bold mb-1">Nombre</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->name }}"
                                   readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold mb-1">Apellido</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->last_name }}"
                                   readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold mb-1">Correo Electrónico</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->email }}"
                                   readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold mb-1">Teléfono</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->telephone }}"
                                   readonly>
                        </div>

                    </div>

                    <div class="mt-4 d-flex gap-2">

                        <a href="{{ route('user.edit', $user->user_id) }}"
                           class="btn btn-primary">
                            Editar Perfil
                        </a>
                        <a href="{{ route('interests.index', $user->user_id) }}"
                           class="btn btn-primary">
                            Mis Intereses
                        </a>

                        <a href="{{ url('/') }}"
                           class="btn btn-primary">
                            Inicio
                        </a>

                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection