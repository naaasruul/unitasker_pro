<?php

namespace Database\Seeders;

use App\Models\Course;
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
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@demo.oo',
            'password' => bcrypt('password'), // Use a secure password
            'role' => 'admin',
        ]);

        // Create a lecturer user
        User::factory()->create([
            'name' => 'Hazama',
            'email' => 'lecturer@demo.oo',
            'password' => bcrypt('password'), // Use a secure password
            'role' => 'lecturer',
        ]);

        // Create a student user
        User::factory()->create([
            'name' => 'Nasrulhaq Hidayat',
            'email' => 'student@demo.oo',
            'password' => bcrypt('password'), // Use a secure password
            'role' => 'student',
        ]);

        Course::create([
            'course_name' => 'Diploma Computer Science',
            'course_code' => 'DCS', 
            'course_credit_hours' => 50,
        ]);

        // Optionally, create additional random users
        // User::factory(10)->create();
    }
}