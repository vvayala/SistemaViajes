<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Playa'],
            ['name' => 'Montaña'],
            ['name' => 'Monumentos'],
            ['name' => 'Museos'],
            ['name' => 'Deportes'],
            ['name' => 'Aventura'],
            ['name' => 'Gastronomía'],
            ['name' => 'Música'],
            ['name' => 'Arte'],
            ['name' => 'Historia'],
            ['name' => 'Naturaleza'],
            ['name' => 'Vida nocturna'],
            ['name' => 'Compras'],
            ['name' => 'Relajación'],
            ['name' => 'Cultura local'],
            ['name' => 'Fotografía'],
            ['name' => 'Festivales'],
            ['name' => 'Arquitectura'],
            ['name' => 'Parques temáticos'],
            ['name' => 'Cruceros'],
        ];

        DB::table('interest')->insert($data);


    }
}
