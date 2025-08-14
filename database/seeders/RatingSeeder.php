<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Rating;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();
        $ratings = [];

        $bookIds = Book::query()->pluck('id')->toArray();

        for ($i = 0; $i < 500_000; $i++) {
            $ratings[] = [
                'book_id' => $bookIds[array_rand($bookIds)],
                'rating' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($ratings) === 5000) {
                DB::table('ratings')->insert($ratings);
                $ratings = [];
            }
        }

        if ($ratings) {
            DB::table('ratings')->insert($ratings);
        }
    }
}

