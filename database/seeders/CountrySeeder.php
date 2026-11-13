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
            ['name' => 'Estados Unidos', 'iata' => 'JFK'],
            ['name' => 'Canadá',         'iata' => 'YYZ'],
            ['name' => 'México',         'iata' => 'MEX'],
            ['name' => 'Guatemala',      'iata' => 'GUA'],
            ['name' => 'El Salvador',    'iata' => 'SAL'],
            ['name' => 'Honduras',       'iata' => 'TGU'],
            ['name' => 'Nicaragua',      'iata' => 'MGA'],
            ['name' => 'Costa Rica',     'iata' => 'SJO'],
            ['name' => 'Panamá',         'iata' => 'PTY'],
            ['name' => 'Belice',         'iata' => 'BZE'],
            ['name' => 'Argentina',      'iata' => 'EZE'],
            ['name' => 'Brasil',         'iata' => 'GRU'],
            ['name' => 'Chile',          'iata' => 'SCL'],
            ['name' => 'Colombia',       'iata' => 'BOG'],
            ['name' => 'Perú',           'iata' => 'LIM'],
            ['name' => 'Uruguay',        'iata' => 'MVD'],
            ['name' => 'Paraguay',       'iata' => 'ASU'],
            ['name' => 'Ecuador',        'iata' => 'UIO'],
            ['name' => 'Bolivia',        'iata' => 'LPB'],
            ['name' => 'Venezuela',      'iata' => 'CCS'],
            ['name' => 'España',         'iata' => 'MAD'],
            ['name' => 'Francia',        'iata' => 'CDG'],
            ['name' => 'Italia',         'iata' => 'FCO'],
            ['name' => 'Alemania',       'iata' => 'BER'],
            ['name' => 'Reino Unido',    'iata' => 'LHR'],
            ['name' => 'Portugal',       'iata' => 'LIS'],
            ['name' => 'Países Bajos',   'iata' => 'AMS'],
            ['name' => 'Suiza',          'iata' => 'ZRH'],
            ['name' => 'Grecia',         'iata' => 'ATH'],
            ['name' => 'Austria',        'iata' => 'VIE'],
            ['name' => 'Japón',          'iata' => 'NRT'],
            ['name' => 'China',          'iata' => 'PEK'],
            ['name' => 'India',          'iata' => 'DEL'],
            ['name' => 'Corea del Sur',  'iata' => 'ICN'],
            ['name' => 'Tailandia',      'iata' => 'BKK'],
            ['name' => 'Vietnam',        'iata' => 'HAN'],
            ['name' => 'Indonesia',      'iata' => 'CGK'],
            ['name' => 'Filipinas',      'iata' => 'MNL'],
            ['name' => 'Malasia',        'iata' => 'KUL'],
            ['name' => 'Singapur',       'iata' => 'SIN'],
            ['name' => 'Sudáfrica',      'iata' => 'JNB'],
            ['name' => 'Egipto',         'iata' => 'CAI'],
            ['name' => 'Marruecos',      'iata' => 'CMN'],
            ['name' => 'Kenia',          'iata' => 'NBO'],
            ['name' => 'Tanzania',       'iata' => 'DAR'],
            ['name' => 'Nigeria',        'iata' => 'LOS'],
            ['name' => 'Ghana',          'iata' => 'ACC'],
            ['name' => 'Túnez',          'iata' => 'TUN'],
            ['name' => 'Australia',      'iata' => 'SYD'],
            ['name' => 'Nueva Zelanda',  'iata' => 'AKL'],
            ['name' => 'Fiyi',           'iata' => 'NAN'],
            ['name' => 'Papúa Nueva Guinea', 'iata' => 'POM'],
            ['name' => 'Samoa',          'iata' => 'APW'],
            ['name' => 'Tonga',          'iata' => 'TBU'],
            ['name' => 'Vanuatu',        'iata' => 'VLI'],
            ['name' => 'Palau',          'iata' => 'ROR'],
        ];

        DB::table('country')->insert($data);
    }
}
