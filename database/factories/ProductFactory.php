<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->realText(10),
            'img_path' => '',
            'price' => $this->faker->numberBetween($min = 50, $max = 999),
            'stock' => $this->faker->numberBetween($min =1, $max = 999),
            'company_id' => $this->faker->numberBetween($min =1, $max = 3),
            'comment' => $this->faker->realText(50),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' =>null,
        ];
    }
}
