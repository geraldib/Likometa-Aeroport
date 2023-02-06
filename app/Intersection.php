<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intersection extends Model
{
    protected $fillable = [
        'name',
        'minutes',
        'sign',
        'road_id'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function road()
    {
        return $this->belongsTo(Road::class);
    }

}
