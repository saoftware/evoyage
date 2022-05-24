<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'nom' => 'DABIRE',
            'prenom' => 'Apollinaire',
            'telephone' => 71242123,
            'email' => 'apollinaire.dabire12@yahoo.com',
            'password' => Hash::make('password'),
            'isClient' => 1
        ]);
    }
}