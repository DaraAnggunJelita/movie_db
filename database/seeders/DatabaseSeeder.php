<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movie;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder kategori jika ada
        // $this->call(CategorySeeder::class);

        // Buat 3 user dummy
        User::factory(3)->create();

        // Buat 10 movie dummy
        // Movie::factory(10)->create();
    }
}
