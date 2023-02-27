<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\Reservation;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $json = file_get_contents(database_path('movies.json'));
        $movies = json_decode($json, true);

        foreach ($movies as $movie) {
            Movie::factory()->count(1)->withMovieData($movie)->create();
            Hall::factory()->count(10)->withMovieData($movie)->create();
            Showtime::factory()->count(10)->withMovieData($movie)->create();
            Seat::factory()->count(10)->withMovieData($movie)->create();
            Reservation::factory()->count(10)->withMovieData($movie)->create();

        }



    }
}
