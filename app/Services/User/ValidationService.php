<?php

namespace App\Services\User;

use App\Age;
use App\Trip;


class ValidationService
{

    public function checkMemberService($validatedData)
    {

        for ($i=0; $i < $validatedData['persNr'] - 1; $i++){
            if($validatedData['memberName'][$i] == null ||
                $validatedData['memberSurname'][$i] == null ||
                $validatedData['memberType'][$i] == null){
                return false;
            }

        }

        return true;

    }

    public function checkPriceService($validatedData)
    {
        $tripPrice = Trip::select('price')
            ->where('st_location', $validatedData['startSelect'])
            ->where('end_location', $validatedData['endSelect'])
            ->get();

        $sum =  $tripPrice[0]->price;

        for ($i=0; $i<$validatedData['persNr']-1; $i++){
            $percentage = Age::select('percentage')
                ->where('name', $validatedData['memberType'][$i])
                ->get();
            $percentage = $percentage[0]->percentage;
            $sum = $sum + ( ( $tripPrice[0]->price * $percentage ) / 100 );
        }

        return $sum == intval($validatedData['price']);

    }

}

