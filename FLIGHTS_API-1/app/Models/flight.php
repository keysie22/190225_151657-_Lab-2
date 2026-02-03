<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'flight_number',
        'origin',
        'destination',
        'departure_time',
        'arrival_time',
        'seats_available'
    ];
}


