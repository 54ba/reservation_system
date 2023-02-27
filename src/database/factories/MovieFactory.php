<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;

class MovieFactory extends Factory
{

    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'release_year' => $this->faker->numberBetween(1900, 2022),
            'director' => $this->faker->name(),
            'casting' => $this->faker->name() . ', ' . $this->faker->name(),
        ];
    }
    public function withMovieData(array $movie)
    {
        return $this->state([
            'title' => $movie['title'],
            'description' => $movie['description'],
            'release_year' => new \DateTime($movie['release_year'] . '-01-01'),
            'director' => $movie['director'],
            'casting' => implode(', ', $movie['casting']),
        ]);
    }


}
