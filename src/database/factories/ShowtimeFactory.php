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
        $hallIds = Hall::all()->pluck('id');
        $movieIds = Movie::all()->pluck('id');

        return [
            'hall_id' => $this->faker->randomElement($hallIds),
            'movie_id' => $this->faker->randomElement($movieIds),
            'date' => $this->faker->date,
            'time' => $this->faker->time,
        ];
    }
    public function withMovieData(array $movie, array $hall)
    {
        return $this->state([
            'name' => $this->faker->word,
            'movie_id' => $movie['id'],
            'hall_id' => $hall['id'],
            'date' => $this->faker->date,
            'time' => $this->faker->time,

        ]);
    }
}
