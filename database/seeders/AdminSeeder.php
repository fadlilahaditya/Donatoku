<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::create([
            'name' => 'Admin Donatoku',
            'email' => 'admin@donatoku.com',
            'password' => Hash::make('admin123'),
            'phone' => '08123456789',
            'address' => 'Donatoku De Patisserie Headquarters',
            'user_type' => 'admin'
        ]);

        // Create sample customer for testing
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => Hash::make('customer123'),
            'phone' => '08987654321',
            'address' => 'Jl. Testing No. 123, Jakarta',
            'user_type' => 'customer'
        ]);
    }
}
