<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lecturer;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lecturer::create([
            'lecturer_name' => 'Dr. John Smith',
            'lecturer_staffId' => 'L12345',
            'lecturer_username' => 'johnsmith',
        ]);

        Lecturer::create([
            'lecturer_name' => 'Prof. Jane Doe',
            'lecturer_staffId' => 'L67890',
            'lecturer_username' => 'janedoe',
        ]);
    }
}
