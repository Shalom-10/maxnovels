<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->paragraph,
            'cover_image' => 'default_cover',
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
