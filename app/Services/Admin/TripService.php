<?php

namespace App\Services\Admin;

use App\Hour;
use App\Road;
use App\Trip;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;

class TripService
{

    public function storeService($request)
    {

        $trip = [
            'st_location' => $request['st_location'],
            'end_location' => $request['end_location'],
            'empty_seats' => $request['empty_seats'],
            'price' => $request['price'],
        ];

        $trip = Trip::create($trip);

        $this->addHoursToTrip($trip, $request);

        return $trip;

    }

    public function editService($trip)
    {

        $hours = DB::table('hours')->where( 'trip_id', $trip->id)->orderBy('id', 'DESC')->get();
        $roads = Road::all();

        return [
            'roads' => $roads,
            'hours' => $hours,
        ];

    }

    public function updateService($trip, $request)
    {

        $trip->st_location  = $request['st_location'];
        $trip->end_location = $request['end_location'];
        $trip->empty_seats  = $request['empty_seats'];

        $trip->save();

        Hour::where('trip_id', $trip->id)->delete();

        $this->addHoursToTrip($trip, $request);

    }

    private function addHoursToTrip($trip, $request)
    {

        foreach ($request['times'] as $time) {
            $timeFrm = strtotime($time);
            Hour::create([
                'st_time' => date('H:i', $timeFrm),
                'trip_id' => $trip->id
            ]);
        }

    }

}
