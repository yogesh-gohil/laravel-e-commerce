<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomDigit(),
            'stock' => $this->faker->randomDigit(),
            'sold_stock' => $this->faker->randomDigit(),
            'sale_price' => $this->faker->randomDigit(),
            'category_id' => Category::factory(),
        ];
    }
}
