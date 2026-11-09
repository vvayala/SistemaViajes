<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ['name'=>'Reserva de hotel'],
            ['name'=>'Reserva de vuelo'],
            ['name'=>'Reserva de transporte terrestre'],
            ['name'=>'Reserva de actividades turísticas'],
            ['name'=>'Reserva de paquetes turísticos'],
            ['name'=>'Reserva de alquiler de vehículos'],
        ];

        DB::table('reservation_type')->insert($data);
    }
}
