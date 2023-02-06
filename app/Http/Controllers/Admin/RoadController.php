<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Road;
use App\Services\Admin\RoadService;
use App\Trip;
use Illuminate\Http\Request;

class RoadController extends Controller
{

    function __construct(RoadService $roadService) {
        $this->roadService = $roadService;
    }

    public function create(Request $request)
    {

        try {
            $road = Road::create(["name" => $request->name]);
        } catch (Exception $e){
            return response()->json($e, 500);
        }

        return response()->json($road, 200);

    }

    public function delete(Road $road)
    {

        try {
            $road->delete();
            $this->roadService->deleteService($road);
        } catch (Exception $e){
            return response()->json($e, 500);
        }

        return response()->json($road, 200);

    }

}
