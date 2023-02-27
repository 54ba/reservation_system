<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $table = 'seats';
    protected $fillable = ['status'];


    public function movie()
    {
        return $this->belongsTo('App\Models\Movie');
    }
    public function hall()
    {
        return $this->belongsTo('App\Models\Hall');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
}
