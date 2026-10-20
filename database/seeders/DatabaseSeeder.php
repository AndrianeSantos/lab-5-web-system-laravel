<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user for login
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@studentgrading.com',
            'password' => Hash::make('password'),
        ]);

        // Seed sample products for the hardware store
        $this->call(StudentSeeder::class);
    }
}
