<?php

namespace App\Http\Controllers\NonUser;
use App\Age;
use App\Http\Controllers\Controller;

use App\Booking;
use App\Http\Requests\BookingStoreRequest;
use App\Intersection;
use App\Road;
use App\Services\Email\EmailService;
use App\Services\NonUser\BookingService;
use App\Services\NonUser\ValidationService;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{

    function __construct(BookingService $bookingService, EmailService $emailService, ValidationService $validationService) {
        $this->bookingService = $bookingService;
        $this->emailService = $emailService;
        $this->validationService = $validationService;
    }

    public function index()
    {
        $allRoads = [];

        try {
            $trips = Trip::with('hours')->get();
            $roads = Road::all();
            $ages = Age::all();
        } catch (Exception $e){
            return $e;
        }

        return view('welcome', compact('trips', 'roads', 'ages'));
    }

    public function store(BookingStoreRequest $request)
    {

        $validatedData = $request->validated();

        $isValidMembersForms = $this->validationService->checkMemberService($validatedData);
        $isValidPrice = $this->validationService->checkPriceService($validatedData);

        if (!$isValidMembersForms){
            return Redirect::back()->withErrors(['Fushat e Anetareve Duhen Plotesuar te Gjitha!']);
        }

        if (!$isValidPrice){
            return Redirect::back()->withErrors(['Cmimi nuk pershtatet me llogaritjet!']);
        }

        try{
            $booking = $this->bookingService->storeService($validatedData);
            $booking = Booking::create($booking);
            $members = $this->bookingService->storeMemberService($validatedData, $booking);
            $this->emailService->sendConfirmationMailService($booking, $members);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('booking_pending', 'Ju lutem konfirmoni rezervimin tuaj ne E-mail qe ju eshte derguar!');
        return redirect('/');
    }

    public function emptySeats(Request $request)
    {

        $data = $this->bookingService->emptySeatsService($request);

        if ($data['errMsg'] != null){
            return response()->json($data['errMsg'], 500);
        }

        return response()->json($data['takenSeats'], 200);

    }

    public function confirmEmail($id, $confirmation)
    {

        try{
            $this->bookingService->confirmEmailService($id, $confirmation);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('booking_sucess', 'Rezervimi Juaj u kofirmua me sukses!');
        return redirect('/');

    }

    public function getNewTime(Request $request){

        $time = $this->bookingService->getNewTimeService($request);

        return response()->json($time, 200);

    }

    public function getIntersections(Request $request)
    {
        $roadId = Road::where('name', $request->name)->value('id');
        $intesections = Intersection::where('road_id', $roadId)->get();
        return response()->json($intesections, 200);
    }

}
