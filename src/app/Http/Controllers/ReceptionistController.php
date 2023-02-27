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

        $movies = Movie::with('showtimes', 'halls', 'seats')->get();



        return response()->json([
            'movies' => $movies,
        ], 200);
    }

    public function getHalls(int $movieId)
    {
        $halls = Hall::where('movie_id', $movieId)->get();

        return response()->json([
            'halls' => $halls,
        ], 200);
    }

    public function getShowTimes(int $movieId, int $hallId)
    {
        $showtimes = Showtime::where('hall_id', $hallId)
        ->where('movie_id', $movieId)
        ->get();

        return response()->json([
            'showtimes' => $showtimes,
        ], 200);
    }

    public function getSeats(int $movieId,int $hallId, int $showtimeId)
    {
        $seats = Seat::where('movie_id', $movieId)->where('hall_id', $hallId)->where('showtime_id', $showtimeId)->get();

        return response()->json([
            'seats' => $seats,
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
