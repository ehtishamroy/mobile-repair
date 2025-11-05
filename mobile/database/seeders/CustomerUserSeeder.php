<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a regular customer user (no admin role)
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'customer@test.com',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        // Note: This user has no roles assigned, so they can login via /login but not /admin/login
    }
}
