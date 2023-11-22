<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use App\Models\Books;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create();

        // Seed data for the 'books' table
        Books::create([
            'title' => $faker->sentence,
            'writer' => $faker->name,
            'genre' => $faker->word,
            'year' => $faker->year,
            'no_inventory' => $faker->unique()->randomNumber(5),
            'stock' => $faker->numberBetween(1, 50),
            'location' => $faker->city,
            'status' => $faker->randomElement(['available', 'blank']),
        ]);
    }
}
