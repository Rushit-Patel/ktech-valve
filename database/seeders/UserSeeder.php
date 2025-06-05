<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@ktech-valve.com'],
            [
                'name' => 'K Tech Admin',
                'email' => 'admin@ktech-valve.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Super Admin User
        User::firstOrCreate(
            ['email' => 'superadmin@ktech-valve.com'],
            [
                'name' => 'Super Administrator',
                'email' => 'superadmin@ktech-valve.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'is_admin' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create your user account
        User::firstOrCreate(
            ['email' => 'rushit@ktech-valve.com'],
            [
                'name' => 'Rushit Patel',
                'email' => 'rushit@ktech-valve.com',
                'password' => Hash::make('rushit123'),
                'email_verified_at' => now(),
                'is_admin' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Test User (as per your example)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Manager User
        User::firstOrCreate(
            ['email' => 'manager@ktech-valve.com'],
            [
                'name' => 'Operations Manager',
                'email' => 'manager@ktech-valve.com',
                'password' => Hash::make('manager123'),
                'email_verified_at' => now(),
                'is_admin' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Sales User
        User::firstOrCreate(
            ['email' => 'sales@ktech-valve.com'],
            [
                'name' => 'Sales Representative',
                'email' => 'sales@ktech-valve.com',
                'password' => Hash::make('sales123'),
                'email_verified_at' => now(),
                'is_admin' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Customer Service User
        User::firstOrCreate(
            ['email' => 'support@ktech-valve.com'],
            [
                'name' => 'Customer Support',
                'email' => 'support@ktech-valve.com',
                'password' => Hash::make('support123'),
                'email_verified_at' => now(),
                'is_admin' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create some additional test users using factory
        User::factory(10)->create([
            'is_admin' => false,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->command->info('Users seeded successfully!');
        $this->command->table(
            ['Name', 'Email', 'Is Admin', 'Status'],
            [
                ['K Tech Admin', 'admin@ktech-valve.com', 'Yes', 'Active'],
                ['Super Administrator', 'superadmin@ktech-valve.com', 'Yes', 'Active'],
                ['Rushit Patel', 'rushit@ktech-valve.com', 'Yes', 'Active'],
                ['Test User', 'test@example.com', 'No', 'Active'],
                ['Operations Manager', 'manager@ktech-valve.com', 'Yes', 'Active'],
                ['Sales Representative', 'sales@ktech-valve.com', 'No', 'Active'],
                ['Customer Support', 'support@ktech-valve.com', 'No', 'Active'],
                ['+ 10 more users', 'via factory', 'No', 'Active'],
            ]
        );
    }
}