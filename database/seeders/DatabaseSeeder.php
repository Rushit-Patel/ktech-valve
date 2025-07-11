<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SampleDataSeeder::class,
            WebsiteSettingsSeeder::class,
        ]);

        $this->command->info('🌱 Database seeding completed successfully!');
    }
}