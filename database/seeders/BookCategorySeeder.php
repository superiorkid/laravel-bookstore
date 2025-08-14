<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookCategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();
        $categories = [];

        for ($i = 0; $i < 3000; $i++) {
            $categories[] = [
                'name' => $faker->word() . ' ' . Str::random(8),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($categories) === 500) {
                DB::table('book_categories')->insert($categories);
                $categories = [];
            }
        }

        if ($categories) {
            DB::table('book_categories')->insert($categories);
        }
    }
}

