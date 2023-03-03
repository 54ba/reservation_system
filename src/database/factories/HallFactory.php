<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hall;
use App\Models\Movie;

class HallFactory extends Factory
{
    protected $model = Hall::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->word,
            'movie_id' => function (array $attributes) {
                return $attributes['movie_id'] ?? Movie::inRandomOrder()->first()->id;
            },

        ];
    }

}
