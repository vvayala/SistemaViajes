@extends('layouts.app')

@section('title', 'Nuevo Chat')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header">

                    <h4 class="mb-0">

                        <i class="bi bi-chat-dots-fill"></i>
                        Nuevo Chat de Soporte

                    </h4>

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
                        action="{{ route('chat.store') }}"
                        method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Asunto

                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ old('title') }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Descripción

                            </label>

                            <textarea
                                name="description"
                                rows="3"
                                class="form-control"
                                required>{{ old('description') }}</textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Mensaje inicial

                            </label>

                            <textarea
                                name="message"
                                rows="5"
                                class="form-control"
                                required>{{ old('message') }}</textarea>

                        </div>

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-send-fill"></i>
                                Crear Chat

                            </button>

                            <a
                                href="{{ route('chat.index') }}"
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