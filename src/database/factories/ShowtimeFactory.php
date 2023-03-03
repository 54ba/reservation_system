<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Hall;

class ShowtimeFactory extends Factory
{

    protected $model = Showtime::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'hall_id' => function (array $attributes) {
                return $attributes['hall_id'] ?? Hall::inRandomOrder()->first()->id;
            },
            'movie_id' => function (array $attributes) {
                return $attributes['movie_id'] ?? Movie::inRandomOrder()->first()->id;
            },
            'date' => $this->faker->date,
            'time' => $this->faker->time,
        ];
    }

}
