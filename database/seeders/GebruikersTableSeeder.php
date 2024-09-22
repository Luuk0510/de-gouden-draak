<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Gebruiker;

class GebruikersTableSeeder extends Seeder
{
    public function run()
    {
        Gebruiker::create([
            'gebruikersnaam' => 'admin',
            'wachtwoord' => Hash::make('password'),
            'rol' => 1,
            'aangemaakt_op' => now(),
            'gewijzigd_op' => now(),
        ]);
    }
}
