<?php

namespace App\Http\Requests;

use App\Rules\StartDate;
use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'fname'          => 'required|string|max:255',
            'lname'          => 'required|string|max:255',
            'email'          => 'required|string|max:255',
            'celNr'          => 'required|max:10|min:10',
            'persNr'         => 'required|max:12|min:1',
            'note'           => '',
            'startSelect'    => 'required|string',
            'endSelect'      => 'required|string',
            'cs_time'        => '',
            'customSelect'   => '',
            'customSelectEnd'=> '',
            'dateStart'      => ['required', new StartDate],
            'timeStart'      => 'required',
            'price'          => 'required',
            'memberName'     => '',
            'memberSurname'  => '',
            'memberType'     => '',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fname.required'         => 'Kerkohet Fusha \'Emer\' te plotesohet!',
            'lname.required'         => 'Kerkohet Fusha \'Mbiemer\' te plotesohet!',
            'email.required'         => 'Kerkohet Fusha \'Email\' te plotesohet!',
            'celNr.required'         => 'Kerkohet Fusha \'NrCel\' te plotesohet!',
            'persNr.required'        => 'Kerkohet Fusha \'Numri i Personave\' te plotesohet!',
            'startSelect.required'   => 'Kerkohet Fusha \'Zgjidh Nisjen\' te plotesohet!',
            'endSelect.required'     => 'Kerkohet Fusha \'Zgjidh Destinacionin\' te plotesohet!',
            'dateStart.required'     => 'Kerkohet Fusha \'Data e nisjes\' te plotesohet!',
            'timeStart.required'     => 'Kerkohet Fusha \'Orari e nisjes\' te plotesohet!',
            'price.required'         => 'Kerkohet Fusha \'Cmimi\' te plotesohet!',
        ];
    }

}
