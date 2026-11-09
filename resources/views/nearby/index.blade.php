@extends('layouts.app')

@section('title', 'Cerca de mí')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="section-title mb-0">
            <i class="bi bi-geo-alt-fill text-danger"></i>
            Cerca de mí
        </h2>

        <span
            class="badge bg-primary"
            id="location-status">

            Obteniendo ubicación...

        </span>

    </div>

    <div class="alert alert-info">

        Mostrando las actividades más cercanas a tu ubicación
        junto con el clima actual.

    </div>

    <div
        id="map"
        class="rounded shadow-sm"
        style="height: 650px;">
    </div>

</div>

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css"
/>

<script
    src="https://unpkg.com/leaflet/dist/leaflet.js">
</script>

<script>

if (
    !new URLSearchParams(
        window.location.search
    ).has('lat')
) {

    navigator.geolocation.getCurrentPosition(

        function(position) {

            const lat =
                position.coords.latitude;

            const lng =
                position.coords.longitude;

            window.location.href =
                "{{ route('nearby.index') }}"
                + '?lat=' + lat
                + '&lng=' + lng;

        }

    );

}

const activities =
    @json($markers);

const map =
    L.map('map')
    .setView(
        [13.6929, -89.2182],
        4
    );

L.tileLayer(
    'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        attribution:
            '&copy; OpenStreetMap'
    }
).addTo(map);

activities.forEach(
    activity => {

    L.marker([
        activity.latitude,
        activity.longitude
    ])
    .addTo(map)
    .bindPopup(`
        <div>

            <h6>
                ${activity.name}
            </h6>

            <p class="mb-1">
                <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                ${activity.city}, ${activity.country}
            </p>

            <p class="mb-1">
                <i class="bi bi-thermometer-half text-warning me-1"></i>
                ${activity.temperature ?? 'N/D'} °C
            </p>

            <p class="mb-2">
                <i class="bi bi-signpost-2-fill text-primary me-1"></i>
                ${activity.distance} km
            </p>

            <a
                href="${activity.url}"
                class="btn btn-sm btn-primary">

                Ver actividad

            </a>

        </div>
    `);

});

if (
    navigator.geolocation
) {

    navigator.geolocation
        .getCurrentPosition(

        function(position) {

            const lat =
                position.coords.latitude;

            const lng =
                position.coords.longitude;

            document
                .getElementById(
                    'location-status'
                )
                .innerHTML =
                    'Ubicación detectada';

            L.marker([
                lat,
                lng
            ])
            .addTo(map)
            .bindPopup(
                '<strong>Tu ubicación</strong>'
            );

            map.setView(
                [lat, lng],
                8
            );

        },

        function() {

            document
                .getElementById(
                    'location-status'
                )
                .innerHTML =
                    'Ubicación no disponible';

        }

    );

}

</script>

@endsection