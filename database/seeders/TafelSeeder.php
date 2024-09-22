<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tafel;

class TafelSeeder extends Seeder
{
    public function run()
    {
        Tafel::insert([
            [
                'capiciteit' => 8,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 8,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 6,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 6,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 6,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 4,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 4,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 4,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 4,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 4,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 2,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 2,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 2,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ],
            [
                'capiciteit' => 2,
                'aangemaakt_op' => now(),
                'gewijzigd_op' => now(),
                'verwijderd_op' => null,
            ]
        ]);
    }
}
