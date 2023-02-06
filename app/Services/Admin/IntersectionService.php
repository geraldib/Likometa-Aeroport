<?php

namespace App\Services\Admin;

class IntersectionService
{


    public function storeService($request)
    {

        $intersection = [
            "name"         => $request->name,
            "minutes"      => (int)$request->minutes,
            "sign"         => $request->sign,
            "road_id"      => (int)$request->road_id,
        ];

        return $intersection;

    }

    public function updateService($intersection, $request)
    {

        $intersection->name     = $request->name;
        $intersection->minutes  = (int)$request->minutes;
        $intersection->sign     = $request->sign;
        $intersection->road_id  = (int)$request->road_id;

        return $intersection;

    }

}
