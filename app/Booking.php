<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'number',
        'nr_persons',
        'note',
        'st_location',
        'end_location',
        'intersection',
        'intersection_end',
        'st_date',
        'st_time',
        'int_time',
        'price',
        'user_id',
        'confirmation',
        'confirmed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function intersection()
    {
        return $this->belongsTo(Intersection::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

}
