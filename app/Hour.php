<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'st_time',
        'trip_id'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
