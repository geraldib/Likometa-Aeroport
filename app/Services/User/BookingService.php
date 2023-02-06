<?php

namespace App\Services\User;

use App\Booking;
use App\Intersection;
use App\Member;
use App\Services\Email\UserEmailService;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingService
{


    function __construct(UserEmailService $emailService) {
        $this->emailService = $emailService;
    }

    public function storeService($validatedData)
    {

        $cs_time             = array_key_exists("cs_time",$validatedData) ? $validatedData['cs_time'] : null;
        $cs_intersection_st  = array_key_exists("customSelect",$validatedData) ? $validatedData['customSelect'] : null;
        $cs_intersection_end = array_key_exists("customSelectEnd",$validatedData) ? $validatedData['customSelectEnd'] : null;

        $booking = [
            "name"             => $validatedData['fname'],
            "surname"          => $validatedData['lname'],
            "email"            => $validatedData['email'],
            "number"           => $validatedData['celNr'],
            "nr_persons"       => $validatedData['persNr'],
            "note"             => $validatedData['note'],
            "st_location"      => $validatedData['startSelect'],
            "end_location"     => $validatedData['endSelect'],
            "intersection"     => $cs_intersection_st,
            "intersection_end" => $cs_intersection_end,
            "int_time"         => $cs_time,
            "st_date"          => $validatedData['dateStart'],
            "price"            => $validatedData['price'],
            'confirmation'     => Str::random(40),
            'confirmed'        => 0,
            "st_time"          => $validatedData['timeStart'],
            "user_id"          => Auth::user()->id,
        ];

        return $booking;

    }

    public function storeMemberService($validatedData, $booking)
    {

        $members = [];

        for ($i=0; $i<$validatedData['persNr']-1; $i++){
            $member = Member::create([
                "name"       => $validatedData['memberName'][$i],
                "surname"    => $validatedData['memberSurname'][$i],
                "age_group"  => $validatedData['memberType'][$i],
                "booking_id" => $booking['id'],
            ]);

            array_push($members, $member);
        }

        return $members;

    }

    public function updateService($validatedData, $booking)
    {

        $cs_time             = array_key_exists("cs_time",$validatedData) ? $validatedData['cs_time'] : null;
        $cs_intersection_st  = array_key_exists("customSelect",$validatedData) ? $validatedData['customSelect'] : null;
        $cs_intersection_end = array_key_exists("customSelectEnd",$validatedData) ? $validatedData['customSelectEnd'] : null;

        $booking->name             = $validatedData['fname'];
        $booking->surname          = $validatedData['lname'];
        $booking->email            = $validatedData['email'];
        $booking->number           = $validatedData['celNr'];
        $booking->st_location      = $validatedData['startSelect'];
        $booking->end_location     = $validatedData['endSelect'];
        $booking->intersection     = $cs_intersection_st;
        $booking->intersection_end = $cs_intersection_end;
        $booking->int_time         = $cs_time;
        $booking->st_date          = $validatedData['dateStart'];
        $booking->st_time          = $validatedData['timeStart'];
        $booking->nr_persons       = $validatedData['persNr'];
        $booking->note             = $validatedData['note'];
        $booking->price            = $validatedData['price'];

        return $booking;

    }

    public function updateMemberService($validatedData, $booking)
    {

        $members = Member::all()->where('booking_id', $booking->id);
        foreach ($members as $member){
            $member->delete();
        }

        for ($i=0; $i<$validatedData['persNr']-1; $i++){
            $member = Member::create([
                "name"       => $validatedData['memberName'][$i],
                "surname"    => $validatedData['memberSurname'][$i],
                "age_group"  => $validatedData['memberType'][$i],
                "booking_id" => $booking['id'],
            ]);
        }

    }

    public function deleteMembersService($id)
    {

        $members = Member::all()->where('booking_id', $id);
        foreach ($members as $member){
            $member->delete();
        }

    }

    public function emptySeatsService($request)
    {

        $takenSeats = 0;
        $rezervedSeat = 0;
        $empty_seats = 0;

        $trips = Trip::all();

        foreach ($trips as $trip){
            if($trip->st_location == $request['st_location'] && $trip->end_location == $request['end_location']){
                $empty_seats = $trip->empty_seats;
            }
        }

        $bookings = Booking::all()
            ->where('st_location', $request['st_location'])
            ->where('end_location', $request['end_location'])
            ->where('st_date', $request['st_date'])
            ->where('st_time', $request['st_time']);

        if (!is_null($bookings)){
            foreach ($bookings as $booking){
                $rezervedSeat = $rezervedSeat + $booking->nr_persons;
            }
            $takenSeats = $empty_seats - $rezervedSeat;
        }

        $errorMsg = [];

        if ($takenSeats < 1)
        {
            array_push($errorMsg, ['error' => 'Nuk ka me vende te lira ne kete "Date" ose "Orar" !']);
        } else if (is_null($request['st_date'])){
            array_push($errorMsg, ['error' => 'Kerkohet te plotesohet fusha "Data e Nisjes" !']);
        } else {
            $errorMsg = null;
        }

        return [
            'errMsg' => $errorMsg,
            'takenSeats' => $takenSeats
        ];

    }

    public function getNewTimeService($request)
    {

        $name = $request['name'];
        $timeSt = $request['time'];
        $timeSt = strtotime($timeSt);

        $intersection = Intersection::where('name', $name)->first();

        if($intersection->sign == 'neg'){
            $time = date("H:i:s", strtotime('-'.$intersection->minutes.' minutes', $timeSt));
        } else {
            $time = date("H:i:s", strtotime('+'.$intersection->minutes.' minutes', $timeSt));
        }

        return $time;

    }

    public function confirmEmailService($id, $confirmation)
    {

        $booking = Booking::findOrFail($id);
        $members = Member::all()->where('booking_id', $id);

        if ($booking->confirmation == $confirmation){
            $booking->confirmed = 1;
            $booking->save();
            $this->emailService->sendMailService($booking, $members);
        }

    }

}
