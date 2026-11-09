@extends('layouts.app')

@section('title', 'Reservas')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="section-title mb-1">

                Reservas

            </h2>

            <p class="text-muted mb-0">

                {{ $trip->title }}

            </p>

        </div>

        <a
            href="{{ route('reservation.create', $trip->trip_id) }}"
            class="btn btn-primary">

            <i class="bi bi-plus-circle me-1"></i>
            Nueva Reserva

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if($reservations->count())

        <div class="card shadow-sm">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th>
                                Nombre
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Actividad
                            </th>

                            <th>
                                Precio
                            </th>

                            <th>
                                Cantidad
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Acción
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($reservations as $reservation)

                            <tr>

                                <td>

                                    <strong>

                                        {{ $reservation->name }}

                                    </strong>

                                    @if($reservation->description)

                                        <br>

                                        <small class="text-muted">

                                            {{ Str::limit(
                                                $reservation->description,
                                                50
                                            ) }}

                                        </small>

                                    @endif

                                </td>

                                <td>

                                    <span class="badge bg-primary">

                                        {{ $reservation->reservationType->name }}

                                    </span>

                                </td>

                                <td>

                                    @if($reservation->activity)

                                        {{ $reservation->activity->name }}

                                    @else

                                        <span class="text-muted">

                                            Sin actividad

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    ${{ number_format(
                                        $reservation->price,
                                        2
                                    ) }}

                                </td>

                                <td>

                                    {{ $reservation->quantity }}

                                </td>

                                <td>

                                    <strong>

                                        ${{ number_format(
                                            $reservation->price * $reservation->quantity,
                                            2
                                        ) }}

                                    </strong>

                                </td>

                                <td>

                                    <form
                                        action="{{ route('reservation.destroy', $reservation->reservation_id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Desea eliminar esta reserva?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger">

                                            <i class="bi bi-trash-fill"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                    <tfoot>

                        <tr>

                            <th colspan="5" class="text-end">

                                Total General

                            </th>

                            <th>

                                ${{ number_format(
                                    $totalAmount,
                                    2
                                ) }}

                            </th>

                            <th></th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    @else

        <div class="alert alert-info">

            No hay reservas registradas para este viaje.

        </div>

    @endif

</div>

@endsection