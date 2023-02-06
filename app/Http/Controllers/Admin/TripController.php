<?php

namespace App\Http\Controllers\Admin;

use App\Hour;
use App\Road;
use App\Services\Admin\TripService;
use App\Trip;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TripController extends Controller
{

    function __construct(TripService $tripService) {
        $this->tripService = $tripService;
    }

    public function index()
    {

        try {
            $trips = Trip::with('hours')->paginate(5);
        } catch (Exception $e) {
            return $e;
        }

        return view('Admin/trips/index', compact('trips'));

    }

    public function create()
    {

        try {
            $roads = Road::all();
        } catch (Exception $e) {
            return $e;
        }

        return view('Admin/trips/create', compact('roads'));

    }

    public function store(Request $request)
    {

        try {
            $this->tripService->storeService($request);
        } catch (Exception $e) {
            return $e;
        }

        return redirect()->route('trips');

    }

    public function edit(Trip $trip)
    {

        try {
            $data = $this->tripService->editService($trip);
        } catch (Exception $e) {
            return $e;
        }

        return view('Admin/trips/edit', $data, compact('trip'));

    }

    public function update(Request $request, Trip $trip)
    {

        try {
            $this->tripService->updateService($trip, $request);
        } catch (Exception $e) {
            return $e;
        }

        session()->flash('trip_edited', 'Linja u ndryshua!');
        return redirect()->route('trips');

    }

    public function delete(Trip $trip)
    {

        try {
            $trip->delete();
        } catch (Exception $e) {
            return $e;
        }

        session()->flash('trip_deleted', 'Linja u fshi!');
        return redirect()->route('trips');

    }

}
