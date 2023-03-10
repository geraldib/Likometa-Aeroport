<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function Intersections()
    {
        return $this->hasMany(Intersection::class);
    }
}
