<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'excerpt' => '<p>' . $this->faker->paragraph() . '</p>',
            'slug' => $this->faker->unique()->slug(3),
            'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(6)) . '</p>',
            'published' => $this->faker->dateTimeBetween('-10 days'),
            // don't forget to import these, e.g. use App\Models\Category;
            'category_id' => Category::factory(), // we created this as well
            'user_id' => User::factory(),
        ];
    }
}
