<?php

namespace Database\Factories;

use App\Models\Genre;
// use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => hash('sha256', $this->faker->realText(10)),
        ];
    }
}
