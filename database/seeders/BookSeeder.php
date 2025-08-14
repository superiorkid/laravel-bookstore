<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();
        $books = [];

        $authorIds = Author::query()->pluck('id')->toArray();
        $categoryIds = BookCategory::query()->pluck('id')->toArray();

        for ($i = 0; $i < 100_000; $i++) {
            $books[] = [
                'name' => $faker->sentence(3),
                'author_id' => $authorIds[array_rand($authorIds)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($books) === 1000) {
                DB::table('books')->insert($books);
                $books = [];
            }
        }

        if ($books) {
            DB::table('books')->insert($books);
        }
    }
}

