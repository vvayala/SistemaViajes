@extends('layouts.app')

@section('title', 'Crear Foro')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    Nuevo Foro
                </div>

                <div class="card-body">

                    <form
                        action="{{ route('forum.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Título
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Descripción
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control"></textarea>

                        </div>
                        <div class="mb-3">

                            <label class="form-label">
                                Imágenes
                            </label>

                            <input
                                type="file"
                                name="images[]"
                                class="form-control"
                                accept="image/*"
                                multiple>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary">
                            Publicar
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection