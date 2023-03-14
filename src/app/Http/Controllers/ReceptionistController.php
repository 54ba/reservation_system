<?php

namespace App\Http\Controllers;

use App\Models\Movie;

use App\Models\Hall;
use App\Models\Showtime;
use App\Models\Seat;
use App\Jobs\HandleMovieData;
use Illuminate\Support\Facades\Cache;



use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function getMovies()
    {

        // $movies = dispatch(new HandleMovieData());
        // $movies = Movie::all();

        $movies = Movie::paginate(20);



        $movies_data = $movies->all();

        return response()->json([
            'movies' => $movies_data,
            'total' => $movies->total(),
            'count' => $movies->count(),
            'per_page' => $movies->perPage(),
            'current_page' => $movies->currentPage(),
            'total_pages' => $movies->lastPage()
        ], 200);
    }

    public function getHalls(int $movieId)
    {
        $halls = Hall::where('movie_id', $movieId)->paginate(20);

        $halls_data = $halls->all();

        return response()->json([
            'halls' => $halls_data,
            'total' => $halls->total(),
            'count' => $halls->count(),
            'per_page' => $halls->perPage(),
            'current_page' => $halls->currentPage(),
            'total_pages' => $halls->lastPage()
        ], 200);
    }

    public function getShowTimes(int $movieId, int $hallId)
    {
        $showtimes = Showtime::where('hall_id', $hallId)
        ->where('movie_id', $movieId)
        ->paginate(20);


        $showtimes_data = $showtimes->all();

        return response()->json([
            'showtimes' => $showtimes_data,
            'total' => $showtimes->total(),
            'count' => $showtimes->count(),
            'per_page' => $showtimes->perPage(),
            'current_page' => $showtimes->currentPage(),
            'total_pages' => $showtimes->lastPage()
        ], 200);


    }

    public function getSeats(int $movieId,int $hallId, int $showtimeId)
    {
        $seats = Seat::where('movie_id', $movieId)->where('hall_id', $hallId)->where('showtime_id', $showtimeId)->paginate(20);


        $seats_data = $seats->all();

        return response()->json([
            'seats' => $seats_data,
            'total' => $seats->total(),
            'count' => $seats->count(),
            'per_page' => $seats->perPage(),
            'current_page' => $seats->currentPage(),
            'total_pages' => $seats->lastPage()
        ], 200);

    }

    public function reserveSeats(Request $request)
    {
        $data = $request->validate([
            'hall_id' => 'required',
            'movie_id' => 'required',
            'showtime_id' => 'required',
            'seat_id' => 'required',
        ]);

        $seat = Seat::where('id', $data['seat_id'])
            ->where('movie_id', $data['movie_id'])
            ->where('hall_id', $data['hall_id'])
            ->where('showtime_id', $data['showtime_id'])
            ->where('status', 'available')
            ->first();

            if (!$seat) {
                return response()->json(['error' => 'Reservation not found'], 404);
            }
                $seat->update(['status' => 'reserved']);
                $seat->refresh();



                return response()->json(["seat" => $seat], 200);

    }

    public function cancelSeats(Request $request)
    {
        $data = $request->validate([
            'hall_id' => 'required',
            'movie_id' => 'required',
            'showtime_id' => 'required',
            'seat_id' => 'required',
        ]);

       $seat = Seat::where('id', $data['seat_id'])
            ->where('movie_id', $data['movie_id'])
            ->where('hall_id', $data['hall_id'])
            ->where('showtime_id', $data['showtime_id'])
            ->where('status', 'reserved')
            ->first();
            if (!$seat) {
                return response()->json(['error' => 'Reservation not found'], 404);
            }
                $seat->update(['status' => 'available']);
                $seat->refresh();

                return response()->json(["seat" => $seat], 200);



    }
}
