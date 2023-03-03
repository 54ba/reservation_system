<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\Movie;
use App\Models\Showtime;




class SeatFactory extends Factory
{

    protected $model = Seat::class;

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
            'showtime_id' => function (array $attributes) {
                return $attributes['showtime_id'] ?? Showtime::inRandomOrder()->first()->id;
            },
            'seat_number' => $this->faker->numberBetween(1, 60),
            'row' => $this->faker->randomLetter,
            'status' => $this->faker->randomElement(['available', 'reserved']),
        ];
    }


}
