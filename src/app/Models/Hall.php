<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    protected $table = 'halls';

    public function movie()
    {
        return $this->belongsTo('App\Models\Movie');
    }

    public function showtimes()
    {
        return $this->hasMany('App\Models\Showtime');
    }

    public function seats()
    {
        return $this->hasMany('App\Models\Seat');
    }
}
