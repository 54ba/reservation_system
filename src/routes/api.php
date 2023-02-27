<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ReservationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'receptionist'], function () {
    Route::get('movies', [ReceptionistController::class,'getMovies']);
    Route::get('halls/{movieId}', [ReceptionistController::class,'getHalls']);
    Route::get('showtimes/{movieId}/{hallId}', [ReceptionistController::class,'getShowtimes']);
    Route::get('seats/{movieId}/{hallId}/{showtimeId}', [ReceptionistController::class,'getSeats']);
    Route::post('reserve', [ReceptionistController::class,'reserveSeats']);
    Route::post('cancel', [ReceptionistController::class,'cancelSeats']);

});


Route::group(['prefix' => 'reservation'], function () {
    Route::post('reserve', [ReservationController::class,'createReservation']);
    Route::post('cancel', [ReservationController::class,'cancelReservation']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
