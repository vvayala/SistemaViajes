@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header text-center">
                    <h4 class="mb-0 fw-bold">
                        Registro de Usuario
                    </h4>
                </div>

                <div class="card-body p-4">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-end fw-semibold">
                                Nombres
                            </label>

                            <div class="col-md-8">
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus>

                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name"
                                class="col-md-4 col-form-label text-md-end fw-semibold">
                                Apellidos
                            </label>

                            <div class="col-md-8">
                                <input
                                    id="last_name"
                                    type="text"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    required>

                                @error('last_name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telephone"
                                class="col-md-4 col-form-label text-md-end fw-semibold">
                                Teléfono
                            </label>

                            <div class="col-md-8">
                                <input
                                    id="telephone"
                                    type="tel"
                                    maxlength="8"
                                    class="form-control @error('telephone') is-invalid @enderror"
                                    name="telephone"
                                    value="{{ old('telephone') }}"
                                    required>

                                @error('telephone')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end fw-semibold">
                                Correo Electrónico
                            </label>

                            <div class="col-md-8">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required>

                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end fw-semibold">
                                Contraseña
                            </label>

                            <div class="col-md-8">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required>

                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end fw-semibold">
                                Confirmar Contraseña
                            </label>

                            <div class="col-md-8">
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role_id"
                                class="col-md-4 col-form-label text-md-end fw-semibold">
                                Rol
                            </label>

                            <div class="col-md-8">
                                <select
                                    id="role_id"
                                    name="role_id"
                                    class="form-select @error('role_id') is-invalid @enderror"
                                    required>

                                    <option value="">
                                        Seleccione un rol
                                    </option>

                                    @foreach ($roles as $role)
                                        <option
                                            value="{{ $role->role_id }}"
                                            {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('role_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">
                            <button
                                type="submit"
                                class="btn btn-primary px-5 py-2 fw-semibold">
                                Registrar
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection