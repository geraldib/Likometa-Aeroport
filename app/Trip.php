<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'st_location',
        'end_location',
        'empty_seats',
        'price'
    ];

    public function hours()
    {
        return $this->hasMany(Hour::class);
    }

}
