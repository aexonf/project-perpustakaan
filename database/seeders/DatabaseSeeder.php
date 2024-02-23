<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use App\Models\Books;
use App\Models\LogBookLoan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'test@example.com',
            'role' => 'librarian',
            'status' => 'active',
        ]);

        // $faker = Faker::create();

        // Books::create([
        //     'series_title' => $faker->sentence,
        //     'call_no' => $faker->sentence,
        //     'description' => $faker->sentence,
        //     'publisher' => $faker->sentence,
        //     'physical_description' => $faker->sentence,
        //     'language' => $faker->sentence,
        //     'isbn_issn' => $faker->sentence,
        //     'classification' => $faker->sentence,
        //     'content_type' => $faker->sentence,
        //     'media_type' => $faker->sentence,
        //     'carrier_type' => $faker->sentence,
        //     'stock' => $faker->numberBetween(1,4),
        //     'edition' => $faker->sentence,
        //     'subject' => $faker->sentence,
        //     'specific_details_info' => $faker->sentence,
        //     'statement' => $faker->sentence,
        //     'responsibility' => $faker->sentence,
        //     'image' => $faker->sentence,
        //     'category' => $faker->sentence,
        //     'status' => $faker->randomElement(['available', 'blank']),
        //     'created_at' => $faker->dateTimeThisDecade->format('Y-m-d H:i:s'),
        //     'updated_at' => $faker->dateTimeThisDecade->format('Y-m-d H:i:s'),
        //     'user_id' => "1",
        // ]);



        // LogBookLoan::create([
        //     'student_id' => "9",
        //     'librarian_id' => "1",
        //     'book_id' => $book->id,
        //     'loan_date' => $faker->dateTimeThisDecade->format('Y-m-d H:i:s'),
        //     'return_date' => $faker->dateTimeThisDecade->format('Y-m-d H:i:s'),
        //     'status' => $faker->randomElement(['pending', 'returned']),
        // ]);
    }
}
