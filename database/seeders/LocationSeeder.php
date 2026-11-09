<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['street' => 'Centro Turístico', 'city' => 'New York', 'country_id' => 1, 'latitude' => 40.7128, 'longitude' => -74.0060],
            ['street' => 'Centro Turístico', 'city' => 'Toronto', 'country_id' => 2, 'latitude' => 43.6532, 'longitude' => -79.3832],
            ['street' => 'Centro Turístico', 'city' => 'Ciudad de México', 'country_id' => 3, 'latitude' => 19.4326, 'longitude' => -99.1332],
            ['street' => 'Centro Turístico', 'city' => 'Antigua Guatemala', 'country_id' => 4, 'latitude' => 14.5597, 'longitude' => -90.7343],
            ['street' => 'Centro Turístico', 'city' => 'San Salvador', 'country_id' => 5, 'latitude' => 13.6929, 'longitude' => -89.2182],
            ['street' => 'Centro Turístico', 'city' => 'Tegucigalpa', 'country_id' => 6, 'latitude' => 14.0723, 'longitude' => -87.1921],
            ['street' => 'Centro Turístico', 'city' => 'Managua', 'country_id' => 7, 'latitude' => 12.1140, 'longitude' => -86.2362],
            ['street' => 'Centro Turístico', 'city' => 'San José', 'country_id' => 8, 'latitude' => 9.9281, 'longitude' => -84.0907],
            ['street' => 'Centro Turístico', 'city' => 'Ciudad de Panamá', 'country_id' => 9, 'latitude' => 8.9824, 'longitude' => -79.5199],
            ['street' => 'Centro Turístico', 'city' => 'Belmopán', 'country_id' => 10, 'latitude' => 17.2514, 'longitude' => -88.7590],
            ['street' => 'Centro Turístico', 'city' => 'Buenos Aires', 'country_id' => 11, 'latitude' => -34.6037, 'longitude' => -58.3816],
            ['street' => 'Centro Turístico', 'city' => 'Rio de Janeiro', 'country_id' => 12, 'latitude' => -22.9068, 'longitude' => -43.1729],
            ['street' => 'Centro Turístico', 'city' => 'Santiago', 'country_id' => 13, 'latitude' => -33.4489, 'longitude' => -70.6693],
            ['street' => 'Centro Turístico', 'city' => 'Bogotá', 'country_id' => 14, 'latitude' => 4.7110, 'longitude' => -74.0721],
            ['street' => 'Centro Turístico', 'city' => 'Lima', 'country_id' => 15, 'latitude' => -12.0464, 'longitude' => -77.0428],
            ['street' => 'Centro Turístico', 'city' => 'Montevideo', 'country_id' => 16, 'latitude' => -34.9011, 'longitude' => -56.1645],
            ['street' => 'Centro Turístico', 'city' => 'Asunción', 'country_id' => 17, 'latitude' => -25.2637, 'longitude' => -57.5759],
            ['street' => 'Centro Turístico', 'city' => 'Quito', 'country_id' => 18, 'latitude' => -0.1807, 'longitude' => -78.4678],
            ['street' => 'Centro Turístico', 'city' => 'La Paz', 'country_id' => 19, 'latitude' => -16.4897, 'longitude' => -68.1193],
            ['street' => 'Centro Turístico', 'city' => 'Caracas', 'country_id' => 20, 'latitude' => 10.4806, 'longitude' => -66.9036],
            ['street' => 'Centro Turístico', 'city' => 'Madrid', 'country_id' => 21, 'latitude' => 40.4168, 'longitude' => -3.7038],
            ['street' => 'Centro Turístico', 'city' => 'París', 'country_id' => 22, 'latitude' => 48.8566, 'longitude' => 2.3522],
            ['street' => 'Centro Turístico', 'city' => 'Roma', 'country_id' => 23, 'latitude' => 41.9028, 'longitude' => 12.4964],
            ['street' => 'Centro Turístico', 'city' => 'Berlín', 'country_id' => 24, 'latitude' => 52.5200, 'longitude' => 13.4050],
            ['street' => 'Centro Turístico', 'city' => 'Londres', 'country_id' => 25, 'latitude' => 51.5074, 'longitude' => -0.1278],
            ['street' => 'Centro Turístico', 'city' => 'Lisboa', 'country_id' => 26, 'latitude' => 38.7223, 'longitude' => -9.1393],
            ['street' => 'Centro Turístico', 'city' => 'Ámsterdam', 'country_id' => 27, 'latitude' => 52.3676, 'longitude' => 4.9041],
            ['street' => 'Centro Turístico', 'city' => 'Zúrich', 'country_id' => 28, 'latitude' => 47.3769, 'longitude' => 8.5417],
            ['street' => 'Centro Turístico', 'city' => 'Atenas', 'country_id' => 29, 'latitude' => 37.9838, 'longitude' => 23.7275],
            ['street' => 'Centro Turístico', 'city' => 'Viena', 'country_id' => 30, 'latitude' => 48.2082, 'longitude' => 16.3738],
            ['street' => 'Centro Turístico', 'city' => 'Tokio', 'country_id' => 31, 'latitude' => 35.6762, 'longitude' => 139.6503],
            ['street' => 'Centro Turístico', 'city' => 'Pekín', 'country_id' => 32, 'latitude' => 39.9042, 'longitude' => 116.4074],
            ['street' => 'Centro Turístico', 'city' => 'Nueva Delhi', 'country_id' => 33, 'latitude' => 28.6139, 'longitude' => 77.2090],
            ['street' => 'Centro Turístico', 'city' => 'Seúl', 'country_id' => 34, 'latitude' => 37.5665, 'longitude' => 126.9780],
            ['street' => 'Centro Turístico', 'city' => 'Bangkok', 'country_id' => 35, 'latitude' => 13.7563, 'longitude' => 100.5018],
            ['street' => 'Centro Turístico', 'city' => 'Hanói', 'country_id' => 36, 'latitude' => 21.0278, 'longitude' => 105.8342],
            ['street' => 'Centro Turístico', 'city' => 'Yakarta', 'country_id' => 37, 'latitude' => -6.2088, 'longitude' => 106.8456],
            ['street' => 'Centro Turístico', 'city' => 'Manila', 'country_id' => 38, 'latitude' => 14.5995, 'longitude' => 120.9842],
            ['street' => 'Centro Turístico', 'city' => 'Kuala Lumpur', 'country_id' => 39, 'latitude' => 3.1390, 'longitude' => 101.6869],
            ['street' => 'Centro Turístico', 'city' => 'Singapur', 'country_id' => 40, 'latitude' => 1.3521, 'longitude' => 103.8198],
            ['street' => 'Centro Turístico', 'city' => 'Ciudad del Cabo', 'country_id' => 41, 'latitude' => -33.9249, 'longitude' => 18.4241],
            ['street' => 'Centro Turístico', 'city' => 'El Cairo', 'country_id' => 42, 'latitude' => 30.0444, 'longitude' => 31.2357],
            ['street' => 'Centro Turístico', 'city' => 'Marrakech', 'country_id' => 43, 'latitude' => 31.6295, 'longitude' => -7.9811],
            ['street' => 'Centro Turístico', 'city' => 'Nairobi', 'country_id' => 44, 'latitude' => -1.2921, 'longitude' => 36.8219],
            ['street' => 'Centro Turístico', 'city' => 'Zanzíbar', 'country_id' => 45, 'latitude' => -6.1659, 'longitude' => 39.2026],
            ['street' => 'Centro Turístico', 'city' => 'Lagos', 'country_id' => 46, 'latitude' => 6.5244, 'longitude' => 3.3792],
            ['street' => 'Centro Turístico', 'city' => 'Accra', 'country_id' => 47, 'latitude' => 5.6037, 'longitude' => -0.1870],
            ['street' => 'Centro Turístico', 'city' => 'Túnez', 'country_id' => 48, 'latitude' => 36.8065, 'longitude' => 10.1815],
            ['street' => 'Centro Turístico', 'city' => 'Sídney', 'country_id' => 49, 'latitude' => -33.8688, 'longitude' => 151.2093],
            ['street' => 'Centro Turístico', 'city' => 'Auckland', 'country_id' => 50, 'latitude' => -36.8509, 'longitude' => 174.7645],
            ['street' => 'Centro Turístico', 'city' => 'Suva', 'country_id' => 51, 'latitude' => -18.1248, 'longitude' => 178.4501],
            ['street' => 'Centro Turístico', 'city' => 'Puerto Moresby', 'country_id' => 52, 'latitude' => -9.4438, 'longitude' => 147.1803],
            ['street' => 'Centro Turístico', 'city' => 'Apia', 'country_id' => 53, 'latitude' => -13.8500, 'longitude' => -171.7500],
            ['street' => 'Centro Turístico', 'city' => 'Nukualofa', 'country_id' => 54, 'latitude' => -21.1394, 'longitude' => -175.2049],
            ['street' => 'Centro Turístico', 'city' => 'Port Vila', 'country_id' => 55, 'latitude' => -17.7333, 'longitude' => 168.3273],
            ['street' => 'Centro Turístico', 'city' => 'Ngerulmud', 'country_id' => 56, 'latitude' => 7.5000, 'longitude' => 134.6242],
            ];

        DB::table('location')->insert($data);
    }
}
