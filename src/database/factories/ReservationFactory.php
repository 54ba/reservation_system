<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\Movie;
use App\Models\Showtime;



use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

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
            'seat_id' => function (array $attributes) {
                return $attributes['seat_id'] ?? Seat::inRandomOrder()->first()->id;
            },
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->email,
        ];
    }

}


