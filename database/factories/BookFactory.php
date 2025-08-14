<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'author_id' => Author::inRandomOrder()->first()->id,
            'category_id' => BookCategory::inRandomOrder()->first()->id,
        ];
    }
}
