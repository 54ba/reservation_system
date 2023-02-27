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
        $hallIds = Hall::all()->pluck('id');
        $movieIds = Movie::all()->pluck('id');
        $showtimeIds = Showtime::all()->pluck('id');
        $seatsIds = Seat::all()->pluck('id');

        return [
            'movie_id' => $this->faker->randomElement($movieIds),
            'hall_id' => $this->faker->randomElement($hallIds),
            'showtime_id' => $this->faker->randomElement($showtimeIds),
            'seat_id' => $this->faker->randomElement($seatsIds),
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->email,
        ];
    }
    public function withMovieData(array $movie, array $hall, array $showtime, array $seat)
    {
        return $this->state([
            'movie_id' => $movie['id'],
            'hall_id' => $hall['id'],
            'showtime_id' => $showtime['id'],
            'seat_id' =>  $seat['id'],
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->email,
        ]);
    }
}


