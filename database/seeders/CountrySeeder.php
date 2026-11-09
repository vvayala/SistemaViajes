<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            // 1. Norteamérica
            ['name' => 'Estados Unidos'],
            ['name' => 'Canadá'],
            ['name' => 'México'],

            // 2. Centroamérica
            ['name' => 'Guatemala'],
            ['name' => 'El Salvador'],
            ['name' => 'Honduras'],
            ['name' => 'Nicaragua'],
            ['name' => 'Costa Rica'],
            ['name' => 'Panamá'],
            ['name' => 'Belice'],

            // 3. Sudamérica
            ['name' => 'Argentina'],
            ['name' => 'Brasil'],
            ['name' => 'Chile'],
            ['name' => 'Colombia'],
            ['name' => 'Perú'],
            ['name' => 'Uruguay'],
            ['name' => 'Paraguay'],
            ['name' => 'Ecuador'],
            ['name' => 'Bolivia'],
            ['name' => 'Venezuela'],

            // 4. Europa
            ['name' => 'España'],
            ['name' => 'Francia'],
            ['name' => 'Italia'],
            ['name' => 'Alemania'],
            ['name' => 'Reino Unido'],
            ['name' => 'Portugal'],
            ['name' => 'Países Bajos'],
            ['name' => 'Suiza'],
            ['name' => 'Grecia'],
            ['name' => 'Austria'],

            // 5. Asia
            ['name' => 'Japón'],
            ['name' => 'China'],
            ['name' => 'India'],
            ['name' => 'Corea del Sur'],
            ['name' => 'Tailandia'],
            ['name' => 'Vietnam'],
            ['name' => 'Indonesia'],
            ['name' => 'Filipinas'],
            ['name' => 'Malasia'],
            ['name' => 'Singapur'],

            // 6. África
            ['name' => 'Sudáfrica'],
            ['name' => 'Egipto'],
            ['name' => 'Marruecos'],
            ['name' => 'Kenia'],
            ['name' => 'Tanzania'],
            ['name' => 'Nigeria'],
            ['name' => 'Ghana'],
            ['name' => 'Túnez'],

            // 7. Oceanía
            ['name' => 'Australia'],
            ['name' => 'Nueva Zelanda'],
            ['name' => 'Fiyi'],
            ['name' => 'Papúa Nueva Guinea'],
            ['name' => 'Samoa'],
            ['name' => 'Tonga'],
            ['name' => 'Vanuatu'],
            ['name' => 'Palau'],
        ];

        DB::table('country')->insert($data);
    }
}
