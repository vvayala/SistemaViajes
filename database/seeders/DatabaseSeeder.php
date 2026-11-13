<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TripTypeSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ReservationTypeSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\InterestSeeder;
use Database\Seeders\BudgetTypeSeeder;
use Database\Seeders\ActivitySeeder;
use Database\Seeders\ImagesSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
            TripTypeSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            LocationSeeder::class,
            InterestSeeder::class,
            BudgetTypeSeeder::class,
            ActivitySeeder::class,
            ImagesSeeder::class,
        ]);

    }
}
