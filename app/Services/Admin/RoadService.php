<?php

namespace App\Services\Admin;

use App\Trip;

class RoadService
{

    public function deleteService($road)
    {
        $trips = Trip::all();

        foreach ($trips as $trip) {
            if($trip->st_location == $road->name || $trip->end_location == $road->name){
                $trip->delete();
            }
        }
    }

}
