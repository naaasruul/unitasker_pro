<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        // User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('password'), // Use a secure password
        //     'role' => 'admin',
        // ]);

        // // Create a lecturer user
        // User::factory()->create([
        //     'name' => 'Lecturer User',
        //     'email' => 'lecturer@example.com',
        //     'password' => bcrypt('password'), // Use a secure password
        //     'role' => 'lecturer',
        // ]);

        // Create a student user
        User::factory()->create([
            'name' => 'Abu Yamin',
            'email' => 'student2@example.com',
            'password' => bcrypt('password'), // Use a secure password
            'role' => 'student',
        ]);

        // Optionally, create additional random users
        // User::factory(10)->create();
    }
}