<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert([
            // ['id' => 1, 'group_name' => 'Group 1', 'course_id' => 1],
            ['id' => 2, 'group_name' => 'OOP', 'course_id' => 1],
        ]);
    }
}
