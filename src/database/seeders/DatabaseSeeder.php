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
            $movie_r = Movie::factory()->count(1)->withRelatedData($movie)->create();
            $movie_id = $movie_r->pluck('id')->first();

            $hall_ids = Hall::factory()->count(4)->create(['movie_id' => $movie_id])->pluck('id');

            foreach ($hall_ids as $hall_id) {

                $showtime_ids =Showtime::factory()->count(4)
                ->create(
                    ['movie_id' => $movie_id,
                     'hall_id' => $hall_id
                    ])->pluck('id');

                    foreach($showtime_ids as $showtime_id)
                    {
                        $seat_ids = Seat::factory()->count(10)
                        ->create(
                            ['movie_id' => $movie_id,
                             'hall_id' => $hall_id,
                             'showtime_id' => $showtime_id
                            ])->pluck('id');
                            // foreach($seat_ids as $seat_id)
                            // {
                                // Reservation::factory()->count(1)
                                // ->create(
                                //     ['movie_id' => $movie_id,
                                //      'hall_id' => $hall_id,
                                //      'showtime_id' => $showtime_id,
                                //      'seat' => $seat
                                //     ]);

                            // }
                    }
            }


        }



    }
}
