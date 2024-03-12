<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(), // ランダムな整数
            'title' => $this->faker->sentence,
            'image_url' => $this->faker->imageUrl(),
            'published_year' => $this->faker->year,
            'is_showing' => $this->faker->boolean,
            'description' => $this->faker->paragraph,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // 過去1年間のランダムな作成日時
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // 過去1年間のランダムな更新日時
        ];
    }
}
