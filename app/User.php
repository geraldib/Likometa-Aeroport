<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'number', 'role', 'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        if ($this->role == 'a') {
            return true;
        } else {
            return false;
        }
    }

    public function isUser()
    {
        if ($this->role == 'u') {
            return true;
        } else {
            return false;
        }
    }

    public function isOffice()
    {
        if ($this->role == 'o') {
            return true;
        } else {
            return false;
        }
    }

    public function getFullNameAttribute()
    {
        if (is_null($this->surname)) {
            return "{$this->name}";
        }

        return "{$this->name} {$this->surname}";
    }

    public function roleName()
    {
        if ($this->role == 'u') {
            return "Perdorues";
        } elseif ($this->role == 'o') {
            return "Zyre Shitje";
        } elseif ($this->role == 'a') {
            return "Administrator";
        } else {
            return "Ti s'je asgje!";
        }
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
