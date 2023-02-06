<?php

namespace App\Services\Admin;

use App\Booking;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function showService($user)
    {

        $bookings = Booking::where('user_id', $user->id);

        return $bookings;

    }

    public function updateService($validatedData, $user)
    {

        $user->name = $validatedData['name'];
        $user->surname  = $validatedData['surname'];
        $user->email    = $validatedData['email'];
        $user->number   = $validatedData['number'];


        if (!is_null($validatedData['current_password'])) {
            if (Hash::check($validatedData['current_password'], $user->password)) {
                $user->password = Hash::make($validatedData['new_password']);
            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        return $user;

    }

    public function deleteUserBookingsService($user)
    {

        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            if($booking->user_id == $user->id || $booking->user_id == $user->id){
                $booking->delete();
            }
        }

    }

}
