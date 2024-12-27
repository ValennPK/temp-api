<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'TestUser',
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'), // Asegúrate de utilizar una contraseña segura
            'email_verified_at' => now(),
        ]);

    }
}
