<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use Database\Factories\MovieFactory;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $json = file_get_contents(database_path('movies.json'));
    $movies = json_decode($json, true);

    foreach ($movies as $movie) {
        Movie::factory()->count(1)->withMovieData($movie)->create();
    }
}


}
