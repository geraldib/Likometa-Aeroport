<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Member;
use App\Services\AfterBookingService;

class AfterBooking extends Controller
{

    function __construct(AfterBookingService $afterBookingService) {
        $this->afterBookingService = $afterBookingService;
    }

    public function downloadPdf($id)
    {

        $booking = Booking::findOrFail($id);
        $members = Member::all()->where('booking_id', $id);

        try{
            $this->afterBookingService->downloadPdfService($booking, $members);
        } catch (Exception $e){
            return $e;
        }

    }

    public function deleteFromEmail($id, $confirmation)
    {

        try{
            $this->afterBookingService->deleteFromEmailService($id, $confirmation);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('booking_deleted', 'Rezervimi Juaj u Anullua!');
        return redirect('/');

    }

}
