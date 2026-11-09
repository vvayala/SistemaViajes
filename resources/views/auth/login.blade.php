@extends('layouts.app')


@section('title', 'Iniciar Sesion')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow-sm">

                <div class="card-header text-center">
                    <h4 class="mb-0 fw-bold">
                        Iniciar Sesión
                    </h4>
                </div>

                <div class="card-body p-4">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-4">
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
                                    required
                                    autofocus>

                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
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

                        
                        <div class="row">
                            <div class="col-md-8 offset-md-4">

                                <button
                                    type="submit"
                                    class="btn btn-primary px-5 py-2 fw-semibold">
                                    Iniciar Sesión
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection