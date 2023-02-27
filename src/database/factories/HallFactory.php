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
        $movieIds = Movie::all()->pluck('id');

        return [
            'name' => $this->faker->word,
            'movie_id' => $this->faker->randomElement($movieIds),


        ];
    }

    public function withMovieData(array $movie)
    {
        return $this->state([
            'name' => $this->faker->word,
            'movie_id' => $movie['id']
        ]);
    }
}
