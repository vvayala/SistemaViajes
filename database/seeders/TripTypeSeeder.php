<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['name'=>'Parejas'],
            ['name'=>'Mochileros'],
            ['name'=>'Familiares'],
            ['name'=>'Negocios'],
            ['name'=>'Mascotas']
        ];

        DB::table('trip_type')->insert($data);
    }
}
