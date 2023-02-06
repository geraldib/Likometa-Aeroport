<?php

namespace App\Services\Admin;

class AgeService
{


    public function storeService($request)
    {

        $age = [
            "name"         => $request->name,
            "percentage"   => (int)$request->percentage,
        ];

        return $age;

    }

    public function updateService($age, $request)
    {

        $age->name     = $request->name;
        $age->percentage  = (int)$request->percentage;

        return $age;

    }

}
