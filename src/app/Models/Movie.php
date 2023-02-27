<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';

    public function showtimes()
    {
        return $this->hasMany('App\Models\Showtime');
    }
    public function halls()
    {
        return $this->hasMany('App\Models\Hall');
    }
    public function seats()
    {
        return $this->hasMany('App\Models\Seat');
    }
}
