<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();
        $authors = [];

        for ($i = 0; $i < 1000; $i++) {
            $authors[] = [
                'name' => $faker->name() . ' ' . rand(1, 9_999),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($authors) === 500) {
                DB::table('authors')->insert($authors);
                $authors = [];
            }
        }

        if ($authors) {
            DB::table('authors')->insert($authors);
        }
    }
}
