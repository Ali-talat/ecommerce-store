<?php

namespace Database\Factories;
use app\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'active' => $this->faker->boolean(),
            'parent_id' => $this->faker->numberBetween(2,9),
        ];
    }
}
