<?php

namespace Database\Factories\Product;

use App\Models\Core\Category;
use App\Models\Product\Attribute;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ['ar' => fake()->unique()->word, 'en' => fake()->unique()->word],
            'price' => fake()->randomFloat(2, 10, 1000),
            'quantity' => fake()->randomNumber(2),
            'is_batteries_shipping' => fake()->randomElement([0, 1]),
            'is_liquid_shipping' => fake()->randomElement([0, 1]),
            'is_batteries_shipping' => fake()->randomElement([0, 1]),
            'is_handcrafted' => fake()->randomElement([0, 1]),
            'status' => fake()->randomElement([0, 1, 2]),
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'item_type' => fake()->randomNumber(2),
        ];
     

    }
}
