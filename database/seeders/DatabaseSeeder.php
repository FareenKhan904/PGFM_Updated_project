<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 1 Student
        User::create([
            'name'     => 'Farheen',
            'email'    => 'student@example.com',
            'password' => bcrypt('Farheen@pgifm2026'), // or '12345678'
            'type'     => User::TYPE_STUDENT,  // 1
        ]);

        // Create 1 Doctor
        User::create([
            'name'     => 'Sahar Aslam',
            'email'    => 'saharaslam@gmail.com',
            'password' => bcrypt('Admin@pgifm2026'),
            'type'     => User::TYPE_DOCTOR,   // 2
        ]);
    }
}