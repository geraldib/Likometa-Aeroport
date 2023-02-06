<?php

namespace App\Http\Controllers\Office;
use App\Age;
use App\Http\Controllers\Controller;

use App\Booking;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingStoreRequest;
use App\Intersection;
use App\Member;
use App\Road;
use App\Services\Email\OfficeEmailService;
use App\Services\Office\BookingService;
use App\Services\Office\ValidationService;
use App\Trip;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{

    function __construct(BookingService $bookingService, OfficeEmailService $emailService, ValidationService $validationService) {
        $this->bookingService = $bookingService;
        $this->emailService = $emailService;
        $this->validationService = $validationService;
    }

    public function index()
    {

        $now = new DateTime();

        try{
            $bookings = Booking::where('user_id', Auth::user()->id)
                ->where('confirmed', 1)
                ->where('st_date','>',$now)
                ->paginate(5);
        } catch (Exception $e){
            return $e;
        }

        return view('office/bookings/index', compact('bookings'));

    }

    public function show($id)
    {

        try{
            $booking = Booking::findOrFail($id);
            $members = Member::all()->where('booking_id', $id);
        } catch (Exception $e){
            return $e;
        }

        return view('office/bookings/show', compact('booking', 'members'));

    }

    public function create()
    {

        try{
            $trips = Trip::with('hours')->get();
            $roads = Road::all();
            $ages  = Age::all();
        } catch (Exception $e){
            return $e;
        }

        return view('office/bookings/create', compact('trips', 'roads', 'ages'));
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
        return redirect()->route('office.bookings');

    }

    public function edit(Booking $booking)
    {

        try{
            $trips = Trip::with('hours')->get();
            $roads = Road::all();
            $members = Member::where('booking_id', $booking->id)->get();
            $ages    = Age::all();
        } catch (Exception $e){
            return $e;
        }

        return view('office/bookings/edit', compact('booking', 'trips', 'roads', 'members', 'ages'));

    }

    public function update(BookingStoreRequest $request, Booking $booking)
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
            $booking = $this->bookingService->updateService($validatedData, $booking);
            $booking->save();
            $this->bookingService->updateMemberService($validatedData, $booking);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('booking_edited', 'Rezervimi u ndryshua me sukses!');
        return redirect()->route('office.bookings');
    }

    public function delete(Booking $booking)
    {

        try{
            $booking->delete();
        } catch (Exception $e){
            return $e;
        }

        session()->flash('booking_deleted', 'Rezervimi u fshi!');
        return redirect()->route('office.bookings');

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
        return redirect()->route('office.bookings');

    }

    public function filterByName(Request $request)
    {

        try{
            $bookings = $this->bookingService->filterByNameService($request);
        } catch (Exception $e){
            return response()->json($e, 500);
        }

        return response()->json($bookings, 200);

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
