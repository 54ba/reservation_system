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

        $hallIds = Hall::all()->pluck('id');
        $movieIds = Movie::all()->pluck('id');
        $showtimeIds = Showtime::all()->pluck('id');

        return [
            'hall_id' => $this->faker->randomElement($hallIds),
            'movie_id' => $this->faker->randomElement($movieIds),
            'showtime_id' => $this->faker->randomElement($showtimeIds),
            'seat_number' => $this->faker->unique()->numberBetween(1, 100),
            'row' => $this->faker->randomLetter,
            'status' => $this->faker->randomElement(['available', 'reserved']),
        ];
    }

    public function withMovieData(array $movie, array $hall, array $showtime)
    {
        return $this->state([
            'name' => $this->faker->word,
            'movie_id' => $movie['id'],
            'hall_id' => $hall['id'],
            'showtime_id' => $showtime['id'],
            'seat_number' => $this->faker->unique()->numberBetween(1, 100),
            'row' => $this->faker->randomLetter,
            'status' => $this->faker->randomElement(['available', 'reserved']),

        ]);
    }
}
