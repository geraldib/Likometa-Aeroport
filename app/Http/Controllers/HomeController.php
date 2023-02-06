<?php

namespace App\Http\Controllers;

use App\Age;
use App\Road;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user  = Auth::user();
        $trips = Trip::with('hours')->get();
        $roads = Road::all();
        $ages = Age::all();

        if (Auth::user()->isAdmin()){
            $users = User::count();

            $widget = [
                'users' => $users,
                //...
            ];
            return view('home', compact('widget'));
        } elseif (Auth::user()->isUser()) {
            return view('/user/bookings/create', compact('trips', 'roads', 'user', 'ages'));
        } elseif (Auth::user()->isOffice()) {
            return view('/office/bookings/create', compact('trips', 'roads', 'user', 'ages'));
        }

    }
}
