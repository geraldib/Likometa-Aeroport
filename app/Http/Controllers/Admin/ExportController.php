<?php

namespace App\Http\Controllers\Admin;
use App\Booking;
use App\Http\Controllers\Controller;

use App\User;
use DateTime;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    public function csvExport(Request $request)
    {

        $fileName = 'perdoruesit.csv';
        $users = User::all()->where('role', 'u');

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Emer', 'Mbiemer', 'Email', 'Numri');

        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $key => $user) {
                $row['Emer']     = $user->name;
                $row['Mbiemer']  = $user->surname;
                $row['Email']    = $user->email;
                $row['Numri']    = $user->number;

                fputcsv($file, array($row['Emer'], $row['Mbiemer'], $row['Email'], $row['Numri']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function csvBookingsExport(Request $request)
    {

        $now = new DateTime();
        $date = $now->format('Y-m-d');
        $bookings = Booking::where('confirmed', 1)->where('st_date' , $date)->get();

        $fileName = 'rezervimet'.$date.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );




        $columns = array('Emer', 'Mbiemer', 'Email', 'Numri Cel', 'Nisja', 'Destinacioni', 'Numri Personave', 'Cmimi', 'Data', 'Orari');

        $callback = function() use($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $key => $booking) {

                $cs_time  = is_null($booking->int_time) ? $booking->st_time : $booking->int_time;
                $cs_st    = is_null($booking->intersection) ? $booking->st_location : $booking->intersection;
                $cs_end   = is_null($booking->intersection_end) ? $booking->end_location : $booking->intersection_end;

                $row['Emer']            = $booking->name;
                $row['Mbiemer']         = $booking->surname;
                $row['Email']           = $booking->email;
                $row['Numri Cel']       = $booking->number;
                $row['Nisja']           = $cs_st;
                $row['Destinacioni']    = $cs_end;
                $row['Numri Personave'] = $booking->nr_persons;
                $row['Cmimi']           = $booking->price;
                $row['Data']            = $booking->st_date;
                $row['Orari']           = $cs_time;

                fputcsv($file, array(
                    $row['Emer'],
                    $row['Mbiemer'],
                    $row['Email'],
                    $row['Numri Cel'],
                    $row['Nisja'],
                    $row['Destinacioni'],
                    $row['Numri Personave'],
                    $row['Cmimi'],
                    $row['Data'],
                    $row['Orari'],
                ));

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
