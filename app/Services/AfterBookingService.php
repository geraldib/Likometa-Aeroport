<?php

namespace App\Services;


use App\Booking;
use App\Member;

class AfterBookingService
{

    public function downloadPdfService($booking, $members)
    {
        $st_time             = is_null($booking->int_time) ? $booking->st_time : $booking->int_time;
        $cs_intersection_st  = is_null($booking->intersection) ? $booking->st_location : $booking->intersection;
        $cs_intersection_end = is_null($booking->intersection_end) ? $booking->end_location : $booking->intersection_end;

        $html = '<bookmark content="Start of the Document" />';
        $html .= '<h1 id="pdf-title">Likometa Aeroport</h1>';
        $html .= '<h3 id="pdf-subtitle">Bilete per Udhetim</h3>';
        $html .= '<h3 id="pdf-table">Detajet</h3>';
        $html .= '<table id="bookings">
                        <thead>
                        <tr>
                            <th scope="col">Nisja</th>
                            <th scope="col">Destinacioni</th>
                            <th scope="col">Data</th>
                            <th scope="col">Orari</th>
                            <th scope="col">Cmimi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>'.$cs_intersection_st.'</td>
                            <td>'.$cs_intersection_end.'</td>
                            <td>'.$booking->st_date.'</td>
                            <td>'.$st_time.'</td>
                            <td>'.$booking->price.'</td>
                        </tr>
                        </tbody>
                    </table>';

        if (!is_null($members)){
            $html .= '<h3 id="pdf-table">Antaret</h3>';
            $html .= '<table id="bookings">
                        <thead>
                        <tr>
                            <th scope="col">Emri</th>
                            <th scope="col">Mbiemri</th>
                            <th scope="col">Grup Mosha</th>
                        </tr>
                        </thead>
                        <tbody>';
            foreach ($members as $member){
                $html .= '<tr>
                                              <td>'.$member->name.'</td>
                                              <td>'.$member->surname.'</td>
                                              <td>'.$member->age_group.'</td>
                                          </tr>';
            }
            $html .=   '</tbody></table>';
        }

        $mpdf = new \Mpdf\Mpdf();
        $stylesheet = file_get_contents(public_path().'/css/ticket.css');
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Likometa-Aeroport.pdf', 'D');

    }

    public function deleteFromEmailService($id, $confirmation){

        $booking = Booking::findOrFail($id);

        if ($booking->confirmation == $confirmation){
            $members = Member::all()->where('booking_id', $id);
            $booking->delete();
            foreach ($members as $member){
                $member->delete();
            }
        }

    }

}

