<?php

namespace App\Services\Email;


use Illuminate\Support\Facades\Mail;

class EmailService
{

    public function sendMailService($booking, $members)
    {

        $to_email = $booking['email'];

        $st_location  = !is_null($booking['intersection']) ? $booking['intersection'] : $booking['st_location'];
        $end_location = !is_null($booking['intersection_end']) ?  $booking['intersection_end'] : $booking['end_location'];
        $st_time      = is_null($booking['int_time']) ?  $booking['st_time'] : $booking['int_time'];

        $data = [
            "name"         => $booking['name'].' '.$booking['surname'],
            "st_location"  => $st_location,
            "end_location" => $end_location,
            "st_date"      => $booking['st_date'],
            "st_time"      => $st_time,
            "price"        => $booking['price'],
            "members"      => $members,
            "id"           => $booking->id,
            "confirmation" => $booking->confirmation,
        ];

        Mail::send('emails.bookings.create', $data, function($message) use ($to_email) {
            $message->to($to_email)
                ->subject('Rezervimi');
            $message->from('ilovemangass@gmail.com','Likometa Aeroprt');
        });

    }

    public function sendConfirmationMailService($booking, $members)
    {

        $st_location  = !is_null($booking['intersection']) ? $booking['intersection'] : $booking['st_location'];
        $end_location = !is_null($booking['intersection_end']) ?  $booking['intersection_end'] : $booking['end_location'];
        $st_time      = is_null($booking['int_time']) ?  $booking['st_time'] : $booking['int_time'];

        $to_email = $booking['email'];
        $data = [
            "name"         => $booking['name'].' '.$booking['surname'],
            "st_location"  => $st_location,
            "end_location" => $end_location,
            "st_date"      => $booking['st_date'],
            "st_time"      => $st_time,
            "confirmation" => $booking['confirmation'],
            "id"           => $booking['id'],
            "price"        => $booking['price'],
            "members"      => $members
        ];

        Mail::send('emails.bookings.confirm', $data, function($message) use ($to_email) {
            $message->to($to_email)
                ->subject('Konfirmo Rezervimin');
            $message->from('ilovemangass@gmail.com','Likometa Aeroprt');
        });

    }

}
