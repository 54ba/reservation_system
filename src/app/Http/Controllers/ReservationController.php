<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Showtime;
use App\Models\Seat;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function createReservation(Request $request)
    {
        $movie_id = $request->input('movie_id');
        $hall_id = $request->input('hall_id');
        $showtimeId = $request->input('showtime_id');
        $seats = $request->input('seats');

        $showtime = Showtime::where('movie_id', $movie_id)
                            ->where('hall_id', $hall_id)
                            ->where('showtime_id', $showtimeId)
                            ->first();

        if (!$showtime) {
            return response()->json(['error' => 'Showtime not found'], 404);
        }

        foreach ($seats as $seat) {
            $seat_info = Seat::where('id', $seat['id'])
                            ->where('status', 'available')
                            ->first();
            if (!$seat_info) {
                return response()->json(['error' => 'Seat not available'], 400);
            }
        }

        foreach ($seats as $seat) {
            $reservation = new Reservation();
            $reservation->showtime_id = $showtime->id;
            $reservation->seat_id = $seat['id'];
            $reservation->customer_name = $request->input('customer_name');
            $reservation->customer_email = $request->input('customer_email');
            $reservation->save();

            $seat_info = Seat::find($seat['id']);
            $seat_info->status = 'reserved';
            $seat_info->save();
        }

        return response()->json(['message' => 'Reservation created successfully'], 201);
    }

    public function cancelReservation(Request $request)
    {
        $reservation_id = $request->input('reservation_id');

        $reservation = Reservation::find($reservation_id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $seat_info = Seat::find($reservation->seat_id);
        $seat_info->status = 'available';
        $seat_info->save();

        $reservation->delete();

        return response()->json(['message' => 'Reservation cancelled successfully'], 200);
    }
}
