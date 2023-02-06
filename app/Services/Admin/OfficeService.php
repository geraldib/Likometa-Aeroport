<?php

namespace App\Services\Admin;

use App\Booking;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OfficeService
{

    public function indexService()
    {

        $offices = User::where('role', 'o')
            ->where('id','!=', Auth::id());

        return $offices;

    }

    public function showService($office)
    {

        $bookings = Booking::where('user_id', $office->id);

        return $bookings;

    }

    public function storeService($validatedData)
    {
        $office = [
            "name"         => $validatedData['name'],
            "surname"      => $validatedData['surname'],
            "email"        => $validatedData['email'],
            "number"       => $validatedData['number'],
            "password"     => Hash::make($validatedData['new_password']),
            "role"         => "o"
        ];

        return $office;
    }

    public function updateService($office, $validatedData)
    {

        $office->name = $validatedData['name'];
        $office->surname  = $validatedData['surname'];
        $office->email    = $validatedData['email'];
        $office->number   = $validatedData['number'];


        if (!is_null($validatedData['current_password'])) {
            if (Hash::check($validatedData['current_password'], $office->password)) {
                $office->password = Hash::make($validatedData['new_password']);
            } else {
                return redirect()->back()->withInput();
            }
        }

        return $office;

    }

    public function deleteService($office)
    {

        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            if($booking->user_id == $office->id || $booking->user_id == $office->id){
                $booking->delete();
            }
        }

    }

}
