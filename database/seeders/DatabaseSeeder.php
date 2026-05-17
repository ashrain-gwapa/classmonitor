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
        // Creates or updates your single permanent administrator account
        User::updateOrCreate(
            ['email' => 'admin@workspace.com'], // Checks if this email exists first to prevent duplicates
            [
                'name' => 'Workspace Admin',
                'school_id' => 'ADMIN-001', // Custom identifier to match your schema requirements
                'role' => 'admin',
                'is_verified' => 1,
                'password' => Hash::make('admin12345'), // Initial master system password
            ]
        );
    }
}